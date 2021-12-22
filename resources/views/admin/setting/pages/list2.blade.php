@if (count($student_courses) < 1)
<p align="center" class="red-text  py-5">No one is enrolled yet</p>
@else

<table>
    <thead>
        <th>Course Name</th>
        <th>Enrolled Student</th>
    </thead>
    <tbody>
        @foreach ($student_courses as $course )
        <tr>
            <td>{{ $course->course_name }}</td>
            <td>
                @foreach ($course->students() as $student )
                <div class="chip">
                    <img src="{{ asset('storage/'.$student->profile) }}" alt="Contact Person">
                    <span style="display: inline-flex">{{ $student->name }} {{ $student->last_name }}
                        <i class="material-icons right" style="font-size: 18px;" onclick="aem._delete(event,'{{ route('setting.index',['type'=>'remove_enrolled_student','id'=>$student->id])}}','#enroll_student_list')"> close</i>
                    </span>

                </div>

                @endforeach
            </td>

        </tr>

        @endforeach

    </tbody>
</table>

@endif
