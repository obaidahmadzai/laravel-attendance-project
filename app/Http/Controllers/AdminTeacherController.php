<?php

namespace App\Http\Controllers;

use App\Events\WhenUserRegisterEvent;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public $active = "teachers";

    public function index()
    {

       return view('admin.teacher.index',[
        'active' => $this->active,
           'teachers' => Teachers::all(),

       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.teacher.forms.create',[
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

      $data = $request->validate([

          'last_name' => 'required|string|min:3|max:90',
          'phone_number' => 'required',
          'address' => 'required',
          'profile' => 'required|file|image',
          'bio' => 'required|max:5000|min:10'
      ]);
      $user2 = $request->validate([
        'name' => 'required|string|min:2|max:90',
        'email' => 'required'
       ]);

     $user =  Teachers::create($data);

     if($request->file('profile') != null){
        $user->update([
            'profile' => $request->file('profile')->store('teacher_profile','public'),
        ]);
    }


      event( new WhenUserRegisterEvent($user,$user2['name'],$user2['email']) );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function show(teachers $teachers)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function edit(Teachers $teacher)
    {

             return view('admin.teacher.forms.edit',[
                 'teacher' => $teacher,
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
    public function update(Request $request, Teachers $teacher)
    {
        $data = $request->validate([

            'last_name' => 'required|string|min:3|max:90',
            'phone_number' => 'required',
            'address' => 'required',

            'bio' => 'required|max:5000|min:10'
        ]);
        $data2 = $request->validate([
          'name' => 'required|string|min:2|max:90',

         ]);
         $request->validate([
            'profile' => 'required|file|image',
         ]);
        User::where('id',$teacher->user_id)->update([
            'name' => $data2['name'],
        ]);
        $teacher->update($data);

        if(file_exists(public_path('storage/'.$teacher->profile))){
            unlink(public_path('storage/'.$teacher->profile));
        }
        $teacher->update([
            'profile' => $request->file('profile')->store('teacher_profile','public'),
        ]);
        return redirect()->to(route('teacher.index'))->with([
            'message'=> 'Updated Successfully',
            'classes'=> 'green rounded'
       ]);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teachers $teacher)
    {
       if(file_exists(public_path('storage/'.$teacher->profile))){
           unlink(public_path('storage/'.$teacher->profile));
       }
       $teacher->delete();
       User::where('id',$teacher->user_id)->delete();

       return redirect('admin/teacher')->with([
            'message'=> 'Successully Deleted',
            'classes'=> 'green rounded'
       ]);

    }
}
