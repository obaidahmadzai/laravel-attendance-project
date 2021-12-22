@extends('layouts.admin',['title' => 'course']);
@section('body')
<div class="row">
    <div class="col s12">
        <div class="card">
            <h6 class="card-title center">
                Create a new course
            </h6>
            <div class="card-content">
                <div class="row">
                    <div class="col s12">

                        <form action="{{ route('course.store') }}" method="POST">
                            @csrf
                            @include('admin.course.forms.inputs')
                            <button type="submit" class="btn waves-effect"> Save
                                <i class="material-icons right"> save<i>
                                </button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
