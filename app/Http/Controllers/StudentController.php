<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Models\User;

class StudentController extends Controller
{ /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public $active = "students";

    public function index()
    {

        return view('admin.student.index',[
            'active' => $this->active,
            'students' => Student::all(),

        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.student.forms.create',[
            'active' => $this->active,

        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {


       $data = $this->my_validate($request);

        $user =  Student::create($data);

        if($request->file('profile') != null){
            $user->update([
                'profile' => $request->file('profile')->store('student_profile','public'),
            ]);
        }
        return redirect()->to(route('student.index'))->with([
            'message'=> 'Added Successfully',
            'classes'=> 'green rounded'
        ]);
    }

    public function show(Student $student)
    {

    }


    public function edit(Student $student)
    {

        return view('admin.student.forms.edit',[
            'student' => $student,
            'active' => $this->active
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\teachers  $teachers
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Student $student)
    {
        $data = $this->my_validate($request);
        $student->update($data);

        if(file_exists(public_path('storage/'.$student->profile))){
            unlink(public_path('storage/'.$student->profile));
        }
        $student->update([
            'profile' => $request->file('profile')->store('student_profile','public'),
        ]);
        return redirect()->to(route('student.index'))->with([
            'message'=> 'Updated Successfully',
            'classes'=> 'green rounded'
        ]);



    }


    public function destroy(Student $student)
    {
        if(file_exists(public_path('storage/'.$student->profile))){
            unlink(public_path('storage/'.$student->profile));
        }
        $student->delete();
        User::where('id',$student->user_id)->delete();

        return redirect('admin/student')->with([
            'message'=> 'Successully Deleted',
            'classes'=> 'green rounded'
        ]);

    }


    public function my_validate($request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'father_name' => 'required|string|min:3',
            'phone_number' => 'required',
            'address' => 'required',
            'profile' => 'required|file|image',
            'email' => 'nullable|required',


        ]);
        $data['is_uni_student'] = ($request->get('is_uni_student')==null?false:true);

        if($data['is_uni_student']!=false)  {
            $data['reg_no'] =  $request->validate(['reg_no' => 'required'])['reg_no'];
             };
             return $data;

    }
}
