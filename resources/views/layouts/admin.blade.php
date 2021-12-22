
@extends('layouts.app')
@section('title','Admin | '. $title)
@section('content')

<ul class="sidenav sidenav-fixed" id="sidenav">
    <li>
        <div style="width: 50%; margin:0 auto;">
            <img src="{{asset('img/logo.png')}}" width="100%">
        </div>
    </li>

    <li class="{{$active=='dashboard' ? 'active' : ''}} waves-effect waves-block " >
        <a href="{{route('admin.index')}}">
            <i class="material-icons left">dashboard</i>
            Dashboard
        </a>
    </li>
    <li class="{{$active=='courses' ? 'active' : ''}} waves-effect waves-block " >
        <a href="{{route('course.index')}}">
            <i class="material-icons left">account_balance</i>
            Courses

        </a>
    </li>
    <li class="{{$active=='teachers' ? 'active' : ''}} waves-effect waves-block " >
        <a href="{{route('teacher.index')}}">
            <i class="material-icons left">person_pin</i>
            Teachers

        </a>
    </li>
    <li class="{{$active=='students' ? 'active' : ''}} waves-effect waves-block " >
        <a href="{{route('student.index')}}">
            <i class="material-icons left">person_pin</i>
            Students

        </a>
    </li>
    <li class="{{$active=='subjects' ? 'active' : ''}} waves-effect waves-block " >
        <a href="{{route('subject.index')}}">
            <i class="material-icons left">format_list_numbered</i>
            Subject

        </a>
    </li>
    <li class="{{$active=='settings' ? 'active' : ''}} waves-effect waves-block " >
        <a href="{{route('setting.index')}}">
            <i class="material-icons left">settings</i>
            Setting

        </a>
    </li>
    @php
    $hide_data = "hide-on-large-only";
    @endphp
    @include('admin.inc.admin-list')
</ul>
<div id="container">
    <nav class="red">
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo ml-lg-4" id="logo">Logo</a>

            <a href="#" data-target="sidenav" class="sidenav-trigger "><i class="material-icons">menu</i></a>

            <ul class="right hide-on-med-and-down">
                <li>
                    <a class='dropdown-trigger waves-effect mr-lg-5' href='#' data-target='dropdown1'>
                        <i class="material-icons left">person_outline</i>
                        {{auth()->user()->name}}
                        <i class="material-icons right">keyboard_arrow_down</i>
                    </a>
                    <ul id='dropdown1' class='dropdown-content'>

                        @php
                        $hide_data = "";
                        @endphp
                        @include('admin.inc.admin-list')
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
    @yield('body')
</div>
<form action="{{route('logout')}}" method="POST" id="logout">
    @csrf
</form>


@endsection
