

@extends('layouts.admin',['title' => 'Update  Teacher'])
@section('body')
<div class="card">

        <h5 class="card-title center">Edit teacher </h5>
        <div class="card-content">
            <form action="{{ route('teacher.update',$teacher->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('admin.teacher.forms.inputs')
                <button type="submit" class="btn waves-effect my-5 mx-5"> Update
                    <i class="material-icons right"> update<i>
                    </button>
                </form>
            </div>
        </div>


    @endsection
