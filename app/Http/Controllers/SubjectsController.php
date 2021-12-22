<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $active = "subjects";
    public function index()
    {
           return view('admin.subject.index',[
               'active' => $this->active,
               'subject' => Subjects::all(),
           ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $subject = new Subjects();
        return response()->json([
            'result' => true,
            'view' => view('admin.subject.forms.create')->render(),
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
           'name' => ['required', 'unique:Subjects'],
       ]);

       Subjects::create($data);

       return response()->json([
        'result' => true,
        'message' => 'Created Successully',
        'view' => view('admin.subject.list',[
            'subject' => Subjects::all()
        ])->render()
    ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function show(Subjects $subjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function edit(Subjects $subject)
    {
        return response()->json([
            'result' => true,
            'view' => view('admin.subject.forms.edit',[
                'subject' => $subject
            ])->render()
        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subjects $subject)
    {
       $data =  $request->validate([
            'name' => ['required','min:3','string',Rule::unique('subjects')->ignore($subject->id)]
        ]);
        $data['status'] = ($request->get('status') == null?false:true);
       $subject->update($data);
        return response()->json([
            'result' => true,
            'message' => 'Updated Successully',
            'view' => view('admin.subject.list',[
                'subject' => Subjects::all()
            ])->render()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subjects $subject)
    {
        $subject->delete();
        return response()->json([
            'status' => true,
            'message' => "Deleted Successully",
            'body' => view('admin.subject.list',[
                'subject' => Subjects::all()
            ])->render()
            ]);

    }
}
