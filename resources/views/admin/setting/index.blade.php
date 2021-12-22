@extends('layouts.admin',['title'=>'Settings'])
@section('body')
<div class="row">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s6">
                <a href="#teacher">Teacher assignment</a>
            </li>
            <li class="tab col s6">
                <a  class="active" href="#student">Student assignment</a>
            </li>

        </ul>
        <div class="col s12" id="teacher">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title center">
                        Assigned teacher list
                    </h4>
                    <div class="subjects" id="list">

                        @include('admin.setting.list')
                    </div>

                </div>
            </div>
        </div>
        <div class="col s12" id="student">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <h4 class="card-title">
                                Enrolled students
                                <div id="enroll_student_list">
                                    @include('admin.setting.pages.list2')
                                </div>
                                <button class="btn  transparent waves-effect  mt-5  btn-floating " onclick="aem.modal('{{ route('setting.index',['page' => 'enroll_student']) }}')">
                                    <i class="material-icons black-text">add</i>
                                </button>
                            </h4>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection
