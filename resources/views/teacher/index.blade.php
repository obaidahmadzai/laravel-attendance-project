@extends('layouts.teacher',['title'=>'Dashboard'])
@section('body')
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <h4 class="card-title center mt-2">
                    Students Attendance
                </h4>
                <div class="card-content">
               @if (count($courses) < 1)
               <p class="red-text center mt-5">NO Course Found!</p>
                @else
                <label>Select a course</label>
                <select name="course" id="course" class="select"  required onchange="aem.loadAjaxFromSelect(event,'{{ route('teacher.dash',['partials'=>'load_subjects','http'=>'ajax'])}}','#subjects',aem.loading(),true)">
                    <option disabled selected> -- Select a course --</option>
                    @foreach ($courses as $course )
                    <option @if(request()->has('course')) {{ request()->get('course') == $course->id ? 'selected' : '' }} @endif value="{{ $course->id }}">{{ $course->course_name }}</option>

                    @endforeach
                </select>
                <div id="subjects">
                    @if (request()->has('load_subjects'))
                    @switch(request()->get('load_subjects'))
                        @case("partials")
                        @include('teacher.forms.subjectslist')

                            @break

                        @default
                        "Not Found!"

                    @endswitch

                    @endif
                </div>
               @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
