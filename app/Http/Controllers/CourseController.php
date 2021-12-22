<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSubjects;
use App\Models\Subjects;
use Illuminate\Http\Request;

class CourseController extends Controller
{
     public $active = "courses";
    public function index()
    {

      return view('admin.course.index',
      [
          'active' => $this->active,
          'r_courses' => Course::where('status','=',Course::$running)->get(),
          'c_courses' => Course::where('status','=',Course::$completed)->get(),
          'u_courses' => Course::where('status','=',Course::$upcoming)->get(),

    ]);
    }


    public function create()
    {
        return view('admin.course.forms.create',[
            'active' => $this->active,
            'subjects' => Subjects::all(),
        ]);
    }


    public function store(Request $request)
    {
       $data =  $request->validate([
           'course_name' => 'required|string|min:3',
            'start_date' => 'required|before:end_date',
            'end_date' => 'required|after:start_date',
            'fee' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);
        $request->validate(['subjects' => 'required']);
        if($request->start_date < date('Y/m/d')){
            $data['status'] = Course::$upcoming;
        }
        $obj = Course::create($data);
        foreach (\request()->get('subjects') as $subject){
                 CourseSubjects::create([
                     'subject_id' => $subject,
                     'course_id' => $obj->id
                 ]);

        }
        return redirect()->to(route('course.index'))->with(
            [
                'message' => 'Course Created Successfully',
                'classes' => 'green rounded'
        ]);
    }


    public function show(Course $course)
    {
        //
    }

    public function edit(Course $course)
    {
        //
    }


    public function update(Request $request, Course $course)
    {
        //
    }


    public function destroy(Course $course)
    {
        //
    }
}
