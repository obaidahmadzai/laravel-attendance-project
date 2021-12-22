@extends('layouts.app')
@section('title','Teacher | '. 'Dashboard')
@section('content')
<div id="container" style="padding-left: 0px">
    <nav class="red">
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo ml-lg-4" id="logo">Welcome</a>

            <a href="#" data-target="sidenav" class="sidenav-trigger "><i class="material-icons">menu</i></a>

            <ul class="right hide-on-med-and-down">
                <li>
                    <a class='dropdown-trigger waves-effect mr-lg-5' href='#' data-target='dropdown1'>
                        <span style="     width: 50px;
                        height: 50px;
                        background: white;
                        border-radius: 50%;
                        margin-right: 15px;
                        overflow: hidden;
                        display: inline-block;
                        float: left;
                        margin-top: 5px;
                        ">
                        <img src="{{ asset('storage/'. auth()->user()->teacher->profile) }}" width="100%" style="z-index: 0">

                    </span>
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
