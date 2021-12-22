<form id="form" data-effect="#enroll_student_list" onsubmit="aem.formRequest(event)"  action="{{ route('setting.index',['type'=>'enroll_student']) }}" method="POST">
    @csrf
    <div class="modal-contant">
        <h6 class=" card-title mt-3 ml-3 center">
           Enroll Student
        </h6>
        <br>
        <div class="row">
            <div class="col s12 input-field">
                     <div>
                         <b>
                            List of courses
                         </b>
                     </div>
                <select  name="course" id="course" class="select" required onchange="aem.loadAjaxFromSelect(event,'{{ route('setting.index',['page'=>'list_of_students'])}}','.students',aem.loading())">
                    <option value="" disabled selected>-- Select a teacher --</option>
                    @foreach ($courses as $courses)
                    <option  value="{{ $courses->id }}">{{ $courses->course_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="students"></div>

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


