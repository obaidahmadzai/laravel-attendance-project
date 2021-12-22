<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSubjects;
use App\Models\Subjects;
use App\Models\TeacherSubjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{

    public function index()
    {
        $subject_ids = TeacherSubjects::where('teacher_id','=',auth()->user()->teacher->id)
        ->select('subject_id')->pluck('subject_id')->toArray();
        $course_ids =  CourseSubjects::whereIn('subject_id',$subject_ids)
        ->selectRaw('DISTINCT(course_id) as course_id')->pluck('course_id')->toArray();
        $courses = Course::whereIn('id',$course_ids)->get();
        $subjects = DB::table('course_subjects')
        ->join('subjects' , 'subjects.id' , '=', 'course_subjects.subject_id')
        ->where('course_subjects.course_id', '=', \request()->get('course'))->get();

        $students = DB::table('student_courses')
        ->join('students' , 'students.id' , '=', 'student_courses.student_id')
        ->where('student_courses.course_id', '=', \request()->get('course'))->get();

        if(\request()->has('partials'))
        {


            switch (\request()->get('partials')) {
                case 'load_subjects':
                    if(\request()->get('http') == "ajax" ){
                        return response()->json([
                            'result' => true,
                            'view' => view('teacher.forms.subjectslist',
                            [
                                'subjects' => $subjects
                                ])->render()
                            ]);
                        }else{
                            return view('teacher.index')->with([
                                'courses' => $courses,
                                'subjects' => $subjects
                            ]);
                        }
                        break;
                        case 'load_students':

                            if(\request()->get('http') == "ajax" ){
                                return response()->json([
                                    'result' => true,
                                    'view' => view('teacher.forms.studentslist',
                                    [
                                        'students' => $students
                                        ])->render()
                                    ]);
                                }else{
                                    return view('teacher.index')->with([
                                        'courses' => $courses,
                                        'subjects' => $subjects,
                                        'students' => $students

                                    ]);
                                }


                        default:
                        abort(404);
                        break;
                    }

                }
                else
                {

                    return view('teacher.index')->with([
                        'courses' => $courses,
                        'subjects' => $subjects,
                        'students' => $students

                    ]);
                }
            }
        }
