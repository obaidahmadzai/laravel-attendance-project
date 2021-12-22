<div class="container">
<div class="row">
<div class="col s12 l9 input-field">
    <input type="text" name="course_name" id="course_name" class="@error('course_name') Invlide @enderror" value="{{ $course->course_name??old('course_name') }}">
    <label for="course_name">Course Name</label>
    @error('course_name')
    <blockquote>
        {{ $message }}
        <blockquote>

    @enderror
</div>
<div class="col s12 l3 input-field">
    <input type="text" name="fee" id="fee" class="@error('fee') Invlide @enderror" value="{{ $course->fee??old('fee') }}">
    <label for="fee">Fee</label>
    @error('Fee')
    <blockquote>
        {{ $message }}
        <blockquote>

    @enderror
</div>

<div class="col s12 l6 input-field">
    <input type="text" name="start_date" id="start_date" class=" datepicker @error('start_date') Invlide @enderror" value="{{ $course->start_date??old('start_date') }}">
    <label for="start_date">Start Date</label>
    @error('start_date')
    <blockquote>
        {{ $message }}
        <blockquote>

    @enderror
</div>
<div class="col s12 l6 input-field">
    <input type="text" name="end_date" id="end_date" class=" datepicker @error('end_date') Invlide @enderror" value="{{ $course->end_date??old('end_date') }}">
    <label for="end_date">End Date</label>
    @error('end_date')
    <blockquote>
        {{ $message }}
        <blockquote>

    @enderror
</div>

<div class="col s12 l6 input-field">
    <input type="text" name="start_time" id="start_time" class=" timepicker @error('start_time') Invlide @enderror" value="{{ $course->start_time??old('start_time') }}">
    <label for="start_time">Start Time</label>
    @error('start_time')
    <blockquote>
        {{ $message }}
        <blockquote>

    @enderror
</div>
<div class="col s12 l6 input-field">
    <input type="text" name="end_time" id="end_time" class=" timepicker @error('end_time') Invlide @enderror" value="{{ $course->end_time??old('end_time') }}">
    <label for="end_time">End Time</label>
    @error('end_time')
    <blockquote>
        {{ $message }}
        <blockquote>

    @enderror
</div>

<div class="input-field col s12">
    <select class="select"  name="subjects[]" id="subjects" multiple required>
      <option value="" disabled selected>Choose subject</option>
     @foreach($subjects as $subject)
         <option value="{{$subject->id}}">{{$subject->name}}</option>
        @endforeach
    </select>
    <label>Select subject</label>
    @error('subjects')
    <blockquote>
        {{ $message }}
        <blockquote>

    @enderror
  </div>
</div>
</div>
<script>
    $(document).ready(() => {
        $('select').formSelect();
    });
</script>
