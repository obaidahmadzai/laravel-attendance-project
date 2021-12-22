<form id="form" data-effect="#list" onsubmit="aem.formRequest(event)"  action="{{ route('subject.store') }}" method="POST">
    @csrf

    <div class="modal-contant">

        <h4 class=" card-title mt-3 ml-3 center">
            Create a new subject
        </h4>

        @include('admin.subject.forms.inputs')
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


