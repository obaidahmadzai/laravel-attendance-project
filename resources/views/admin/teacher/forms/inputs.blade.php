<div class="container">
<div class="row">
    <div class="col s12 center">
        <span style="display:inline-block;width:100px;height:100px;overflow:hidden;border-radius:50%;border:1px solid black;">
        <img id="profile_preview" class="lazy" data-src="{{ isset($teacher)? asset('storage/'.$teacher->profile) : asset('img/person.png')}}" width="100%">
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
    <div class="col s12 l6 input-field">

        <input type="text" name="name" id="name" class="@error('name') Invlide @enderror" value="{{ $teacher->user->name??old('name') }}">
        <label for="name"> Name</label>
        @error('name')
        <blockquote>
            {{ $message }}
            <blockquote>

        @enderror
    </div>
    <div class="col s12 l6 input-field">
        <input type="text" name="last_name" id="last_name" class="@error('last_name') Invlide @enderror" value="{{ $teacher->last_name??old('last_name') }}">
        <label for="last_name">Last Name</label>
        @error('last_name')
        <blockquote>
            {{ $message }}
            <blockquote>

        @enderror
    </div>

    <div class="col s12 l4 input-field">
        <i class="material-icons prefix">phone</i>
        <input type="text" name="phone_number" id="phone_number" class="  @error('phone_number') Invlide @enderror" value="{{ $teacher->phone_number??old('phone_number') }}">
        <label for="phone_number">Phone Number</label>
        @error('phone_number')
        <blockquote>
            {{ $message }}
            <blockquote>

        @enderror
    </div>
    <div class="col s12 l4 input-field">
        <i class="material-icons prefix">email</i>
        <input type="email" name="email" id="email" class="  @error('email') Invlide @enderror" @if(isset($teacher)) disabled @endif value="{{ $teacher->email??old('email') }}">
        <label for="email">Email</label>
        @error('email')
        <blockquote>
            {{ $message }}
            <blockquote>

        @enderror
    </div>

    <div class="col s12 l4 input-field">
        <i class="material-icons prefix">location_on</i>
        <input type="text" name="address" id="address" class="  @error('address') Invlide @enderror" value="{{ $teacher->address??old('address') }}">
        <label for="address">Address</label>
        @error('address')
        <blockquote>
            {{ $message }}
            <blockquote>

        @enderror
    </div>
    <div class="col s12 l12">
        <textarea name="bio" id="bio" class="@error('bio') Invlide @enderror" id="bio" cols="10" rows="30">{{$teacher->bio??old('bio')}}</textarea>
        @error('bio')
        <blockquote>
            {{ $message }}
            <blockquote>

        @enderror
    </div>
    </div>
</div>
    @push('js')
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('bio');
        $('input[type="file"]').on('change', function(){
        aem.changeImage(this);

    });
    </script>
    @endpush
