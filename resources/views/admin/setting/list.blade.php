
<table>
    <thead>
        <tr>
            <th>
                Teachers
            </th>
            <th>
                Subjects
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teachers as $teacher )
        <tr>
            <td>
                {{ $teacher->user->name  }} {{ $teacher->last_name  }}
            </td>
            <td>

                <ol>
                    @foreach ($teacher->subjects() as $subjects )
                    <li>
                        {{ $subjects->name }}
                        <button type="button"  class="btn btn-small btn-floating transparent z-debth-0 " onclick="aem._delete(event,'{{route('setting.index',['id'=>$subjects->ts_id,'_token'=>csrf_token()])}}','#list')">
                            <i class="material-icons red-text">delete</i>
                        </button>
                    </li>
                    @endforeach

                </ol>
                <button  onclick="aem.modal('{{route('setting.index',['page' => 'assigned_teacher_to_subject','teacher_id' => $teacher->id ])}}')" class="btn btn-small waves-effect mx-4 transparent black-text center">
                    Assign
                </button>




            </td>
        </tr>
        @endforeach
    </tbody>
</table>
