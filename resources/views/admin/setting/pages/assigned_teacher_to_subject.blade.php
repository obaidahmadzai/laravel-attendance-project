<form id="form" data-effect="#list" onsubmit="aem.formRequest(event)"  action="{{ route('setting.index',['type'=>'assign_request']) }}" method="POST">
    @csrf
    <div class="modal-contant">
        <h6 class=" card-title mt-3 ml-3 center">
            Assign subject to to teachers
        </h6>
        <br>
        <div class="row">
            <div class="col s12 input-field">
                     <div>
                         <b>
                             Select a teacher
                         </b>
                     </div>
                <select  name="teacher_id" id="teacher" class="select" required>
                    <option value="" disabled selected>-- Select a teacher --</option>
                    @foreach ($teachers as $teacher)
                    <option @if(request()->has('teacher_id')) {{ $teacher->id == request()->get('teacher_id')? 'selected' : '' }}@endif value="{{ $teacher->id }}">{{ $teacher->user->name }} {{ $teacher->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col s12 input-field">
                <div>
                    <b>
                        Select subjects
                    </b>
                </div>
                <select name="subjects[]" id="subject" class="select"   required multiple>
                    @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn green waves-effect form_button"> Save
                <i class="material-icons right"> save<i>
                </button>
                <button type="button" class="modal-close btn red waves-effect "> close
                    <i class="material-icons right">cancel<i>
                    </button>

                </div>
            </div>
        </form>


<script>
    $(document).ready(() => {

    $('select').formSelect();
    });
</script>


