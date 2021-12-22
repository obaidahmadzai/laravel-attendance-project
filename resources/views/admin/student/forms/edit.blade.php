@extends('layouts.admin',['title' => 'Update  student'])
@section('body')
<div class="card">
    <div class="container">
        <div class="card-content">
            <h4 class="card-title">
                Edit student information
            </h4>
            <form action="{{ route('student.update',$student->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('admin.student.forms.inputs')
                <button type="submit" class="btn waves-effect my-5 mx-5"> Update
                    <i class="material-icons right"> update<i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @endsection
