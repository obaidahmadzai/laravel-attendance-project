@extends('layouts.admin',['title'=>'Subjects List'])
@section('body')
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <h4 class="card-title center">
                    Subjects List
                </h4>
                <div class="subjects" id="list">
                    <div class="row">
                        <div class="col s12 m6 input-field ">
                            <i class="material-icons prefix">search</i>
                            <input type="search" name="search" id="search" onkeyup="search(event,'table tr')">
                            <label for="search">Search Subject</label>

                        </div>
                    </div>
                    @include('admin.subject.list')
                </div>
                <button  onclick="aem.modal('{{route('subject.create')}}')" class="btn btn-large btn-floating waves-effect  my-5 mx-5 transparent">
                    <i class="material-icons black-text">save</i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
