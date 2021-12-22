<div class="container">
<div class="row">
    <div class="col s12 center">
        <span style="display:inline-block;width:100px;height:100px;overflow:hidden;border-radius:50%;border:1px solid black;">
        <img id="profile_preview" class="lazy" data-src="{{ isset($student)? asset('storage/'.$student->profile) : asset('img/person.png')}}" width="100%">
        </span>
    <br><label for="profile" type="button" class="btn btn-small waves-effect btn-floating transparent z-depth-0 ">
        <i class="material-icons black-text ">edit</i>
    </label>
    <input type="file" name="profile" class="d-none " accept="image/*" id="profile">
    @error('profile')
        <blockquote>
            {{ $message }}
            <blockquote>

        @enderror
    </div>
    <div class="col s12 l4 input-field">

        <input type="text" name="name" id="name" class="@error('name') Invlide @enderror" value="{{ $student->name??old('name') }}">
        <label for="name"> Name</label>
        @error('name')
        <blockquote>
            {{ $message }}
            <blockquote>
        @enderror
    </div>
    <div class="col s12 l4 input-field">
        <input type="text" name="last_name" id="last_name" class="@error('last_name') Invlide @enderror" value="{{ $student->last_name??old('last_name') }}">
        <label for="last_name">Last Name</label>
        @error('last_name')
        <blockquote>
            {{ $message }}
            <blockquote>

        @enderror
    </div>
    <div class="col s12 l4 input-field">
        <input type="text" name="father_name" id="father_name" class="@error('father_name') Invlide @enderror" value="{{ $student->father_name??old('father_name') }}">
        <label for="last_name">Father name</label>
        @error('father_name')
        <blockquote>
            {{ $message }}
            <blockquote>

        @enderror
    </div>

    <div class="col s12 l4 input-field">
        <i class="material-icons prefix">phone</i>
        <input type="text" name="phone_number" id="phone_number" class="  @error('phone_number') Invlide @enderror" value="{{ $student->phone_number??old('phone_number') }}">
        <label for="phone_number">Phone Number</label>
        @error('phone_number')
        <blockquote>
            {{ $message }}
            <blockquote>

        @enderror
    </div>
    <div class="col s12 l4 input-field">
        <i class="material-icons prefix">email</i>
        <input type="email" name="email" id="email" class="  @error('email') Invlide @enderror" value="{{ $student->email??old('email') }}">
        <label for="email">Email</label>
        @error('email')
        <blockquote>
            {{ $message }}
            <blockquote>

        @enderror
    </div>

    <div class="col s12 l4 input-field">
        <i class="material-icons prefix">location_on</i>
        <input type="text" name="address" id="address" class="  @error('address') Invlide @enderror" value="{{ $student->address??old('address') }}">
        <label for="address">Address</label>
        @error('address')
        <blockquote>
            {{ $message }}
            <blockquote>

        @enderror
    </div>
    <div class="col s12">
        <p>
            <label>
                <input type="checkbox" value="1" name="is_uni_student" onchange="aem.toggleElement('#reg_no')" @if(isset($student)) {{$student->is_uni_student?'checked':' '}} @else  @endif">
                <span>Is university student</span>
            </label>
        </p>
    </div>
    <div class="col s12 l6 input-field" id="reg_no" style="display: @if(isset($student)) {{$student->is_uni_student?'block':'none'}} @else none @endif">
        <input type="text" name="reg_no" id="reg_no" class="  @error('reg_no') Invlide @enderror" value="{{ $student->reg_no??old('reg_no') }}">
        <label for="reg_no">Reg_no</label>
        @error('reg_no')
        <blockquote>
            {{ $message }}
            <blockquote>

        @enderror
    </div>

    </div>
</div>

@push('js')
<script>
    $('input[type="file"]').on('change', function(){
        aem.changeImage(this);

    });
</script>

@endpush


