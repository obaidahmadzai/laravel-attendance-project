<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSubjects;
use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Models\Subjects;
use App\models\TeacherSubjects;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index(){
      if(\request()->method() == "GET"){
        if(\request()->has('page')){
            switch(\request()->get('page')){
                  case 'assigned_teacher_to_subject':
                     return response()->json([
                         'result' => true,
                         'view' => view('admin.setting.pages.assigned_teacher_to_subject',[
                             'teachers' => Teachers::all(),
                             'subjects' => Subjects::all()
                         ])->render()
                     ]);
                     break;
                     case 'enroll_student':
                        return response()->json([
                            'result' => true,
                            'view' => view('admin.setting.pages.enroll_student',[
                                'courses' => Course::where('status', '=', Course::$running)->get()
                            ])->render()
                        ]);
                        break;
                        case 'list_of_students':

                           $ids = StudentCourse::where('course_id', '=', \request()->get('course'))->pluck('student_id')->toArray();
                         $students =   Student::whereNotIn('id',$ids)->get();

                            return response()->json([
                                'result' => true,
                                'view' => view('admin.setting.pages.list_of_students',
                                [
                                    'students' => $students
                                ])->render(),
                            ]);
                            break;



                     default:
                     abort(404);
            }

         }else{
           $studentarr =  StudentCourse::distinct('course_id')->pluck('course_id')->toArray();

             return view('admin.setting.index',[
                 'active' => 'settings',
                 'teachers' => Teachers::all(),
                 'student_courses' => Course::whereIn('id',$studentarr)->get(),
             ]);
         }
      }elseif(\request()->method() == "POST")
      {
          if(\request()->has('type'))
          {
              switch(\request()->get('type'))
              {
                  case 'assign_request':
                    \request()->validate([
                        'teacher_id' => 'required'
                    ]);
                    \request()->validate([
                      'subjects' => 'required'
                  ]);
                  foreach(\request()->get('subjects') as $subject_id){
                      TeacherSubjects::create([
                          'teacher_id' => \request()->get('teacher_id'),
                          'subject_id' => $subject_id

                      ]);


                  }
                  return response()->json([
                      'result' => true,
                      'message' => 'Assign Successfully',
                      'view' => view('admin.setting.list',[
                          'teachers' => Teachers::all(),
                      ])->render()
                  ]);
                  break;
                  case 'enroll_student':
                    foreach(\request()->get('students') as $student){
                        StudentCourse::create([
                            'student_id' => $student,
                            'course_id' => \request()->get('course')
                        ]);
                    }
                    $studentarr =  StudentCourse::distinct('course_id')->pluck('course_id')->toArray();
                    return response()->json([
                        'result' => true,
                        'message' => 'Enrolled Successfully',
                        'view' => view('admin.setting.pages.list2',[
                            'student_courses' => Course::whereIn('id',$studentarr)->get(),
                        ])->render()
                    ]);
                    break;





                }
            }


        }
        else{

            if(\request()->has('type'))
            {

                switch(\request()->get('type')){
                    case 'remove_enrolled_student':
                        StudentCourse::where('student_id',\request()->get('id'))->delete();
                        $studentarr =  StudentCourse::distinct('course_id')->pluck('course_id')->toArray();
                        return response()->json([
                            'status' => true,
                            'message' => 'Remove Successfully',
                            'body' => view('admin.setting.pages.list2',[
                                'student_courses' => Course::where('status', '=', Course::$running)->get()
                            ])->render()

                        ]);
                        break;

                    }
                }
                else{
                TeacherSubjects::where('id',\request()->get('id'))->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Remove Successfully',
                    'body' => view('admin.setting.list',[
                        'teachers' => Teachers::all(),
                        'subjects' => Subjects::all()

                        ])->render()

                    ]);
                }
            }


            }
        }
