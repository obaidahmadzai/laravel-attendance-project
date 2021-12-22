<div class="row">
    <div class="col s12 input-field input-parent">
        <input type="text" name="name" id="subject" class="@error('name') Invlid @enderror" value="{{ $subject->name??old('name') }}">
        <label for="name">Subject Name</label>
        <span class="validation-message"></span>
    </div>
    @if(isset($subject))

    <div class="col s12">
        <p>
            <label>
                <input type="checkbox" name="status" value="1" {{ $subject->status?'checked':'' }}>
                <span>Status</span>
            </label>
        </p>
    </div>
  @else
  <div class="col s12">
    <p>
        <label>
            <input type="checkbox" name="status" value="1" >
            <span>Status</span>
        </label>
    </p>
</div>

    @endif
</div>
