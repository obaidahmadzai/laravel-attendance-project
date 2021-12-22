<div class="col s12 input-field">
    <div>
        <b>
           List of students
        </b>
    </div>
<select  name="students[]" id="students" class="select" required multiple>

   @foreach ($students as $student)
   <option  value="{{ $student->id }}">{{ $student->name }} {{ $student->last_name }}</option>
   @endforeach
</select>
</div>
<script>
    $(document).ready(() => {

    $('select').formSelect();
    });
</script>
