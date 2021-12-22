@extends('layouts.admin',['title' => 'Add a New student'])
@section('body')
<div class="row">
    <div class="col 12">
        <div class="card">
            <h4 class="card-title center">
                Add a new student
            </h4>

            <div class="card-content">
                <form action="{{ route('student.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('admin.student.forms.inputs')
                    <button type="submit" class="btn waves-effect my-5 mx-5"> Save
                        <i class="material-icons right"> save<i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    @endsection
