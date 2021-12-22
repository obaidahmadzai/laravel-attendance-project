@if (count($subjects) < 1)

<p class="red-text center mt-5">NO Subject Found!</p>
 @else
 <label>Select a subject</label>
 <select name="subject" id="subject" class="select"   required onchange="aem.loadAjaxFromSelect(event,'{{ route('teacher.dash',['partials'=>'load_students','http'=>'ajax'])}}','#students',aem.loading(),true)">
    <option disabled selected> -- Select a subject --</option>
     @foreach ($subjects as $subject )
     <option @if(request()->has('subject')) {{ request()->get('subject') == $subject->id ? 'selected' : '' }} @endif value="{{ $subject->id }}&course={{ request()->get('course') }}">{{ $subject->name }}</option>

     @endforeach

 </select>
 @endif
 <div id="students">

 </div>
 <script>
    $(document).ready(() => {

    $('select').formSelect();
    });
</script>


