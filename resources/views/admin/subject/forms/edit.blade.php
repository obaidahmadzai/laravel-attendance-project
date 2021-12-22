<form id="form" data-effect="#subjects" onsubmit="aem.formRequest(event)"  action="{{ route('subject.update',$subject->id)}}" method="POST">
    @csrf
@method('PATCH')
    <div class="modal-contant">

        <h4 class=" card-title mt-3 ml-3 center">
           Edit Subject
        </h4>

        @include('admin.subject.forms.inputs')
        <div class="modal-footer">

            <button type="submit" class="btn green waves-effect form_button">Update
                <i class="material-icons right">edit<i>
                </button>
                <button type="button" class="modal-close btn red waves-effect ">close
                    <i class="material-icons right">cancel<i>
                    </button>

                </div>
            </div>
        </form>

<script>
    M.updateTextFields();
</script>
