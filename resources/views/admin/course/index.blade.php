@extends('layouts.admin',['title' => 'Course'])
@section('body')
<div class="card">
    <div class="content">
        <h4 style="text-align: center" class="my-4"> Courses List</h4>
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab"><a class="active" href="#test1">Running</a></li>
                    <li class="tab"><a href="#test2">Upcoming</a></li>
                    <li class="tab"><a href="#test3"> Complete</a></li>
                </ul>
            </div>

            <div id="test1" class="col s12">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Course Name</th>
                            <th>Total Subject</th>
                            <th>Total Students</th>
                            <th>Start Date</th>
                            <th>Fee </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if ($r_courses->count() < 1)
                            <td colspan="6" class="center red-text"> NO Record Found </td>
                        </tr>

                            @else
                            @php $i = 1;@endphp
                            @foreach ($r_courses as $running )
                             <tr>
                               <td>
                                {{ $i++ }}
                               </td>
                               <td>
                                  {{$running->course_name  }}
                               </td>
                               <td>
                                 <button type="button" class="btn btn-small waves-effect transparent  black-text">  {{ count($running->courses()) }}</button>
                               </td>
                               <td>{{ count($running->students()) }}</td>
                               <td>{{ $running->start_date }}</td>
                               <td>{{ $running->fee }}</td>
                               <td>
                                   <a  class="btn btn-small waves-effect transparent black-text" href="{{ route('course.edit',['course' => $running->id]) }}">Edit</a>
                               </td>
                             </tr>
                            @endforeach
                            @endif
                    </tbody>
                </table>

            </div>
            <div id="test2" class="col s12">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Course Name</th>
                            <th>Total Subject</th>
                            <th>Total Students</th>
                            <th>Start Date</th>
                            <th>Fee </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if ($u_courses->count() < 1)
                            <td colspan="6" class="center red-text"> NO Record Found </td>
                        </tr>

                            @else
                            @php $i = 1;@endphp
                            @foreach ($u_courses as $running )
                             <tr>
                               <td>
                                {{ $i++ }}
                               </td>
                               <td>
                                  {{$running->course_name  }}
                               </td>
                               <td>
                                 <button type="button" class="btn btn-small waves-effect transparent  black-text">  {{ count($running->courses()) }}</button>
                               </td>
                               <td>0</td>
                               <td>{{ $running->start_date }}</td>
                               <td>{{ $running->fee }}</td>
                               <td>
                                   <a  class="btn btn-small waves-effect transparent black-text" href="{{ route('course.edit',['course' => $running->id]) }}">Edit</a>
                               </td>
                             </tr>
                            @endforeach
                            @endif
                    </tbody>
                </table>
            </div>
            <div id="test3" class="col s12">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Course Name</th>
                            <th>Total Subject</th>
                            <th>Total Students</th>
                            <th>Start Date</th>
                            <th>Fee </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if ($c_courses->count() < 1)
                            <td colspan="6" class="center red-text"> NO Record Found </td>
                        </tr>

                            @else
                            @php $i = 1;@endphp
                            @foreach ($c_courses as $running )
                             <tr>
                               <td>
                                {{ $i++ }}
                               </td>
                               <td>
                                  {{$running->course_name  }}
                               </td>
                               <td>
                                 <button type="button" class="btn btn-small waves-effect transparent  black-text">  {{ count($running->courses()) }}</button>
                               </td>
                               <td>0</td>
                               <td>{{ $running->start_date }}</td>
                               <td>{{ $running->fee }}</td>
                               <td>
                                   <a  class="btn btn-small waves-effect transparent black-text" href="{{ route('course.edit',['course' => $running->id]) }}">Edit</a>
                               </td>
                             </tr>
                            @endforeach
                            @endif
                    </tbody>
                </table>
            </div>
            <div class="col s12">
                <a href="{{ route('course.create') }}" class="btn my-2 " > Create New Course</a>
            </div>

        </div>
    </div>
</div>
@endsection
