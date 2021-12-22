@extends('layouts.app')


@section('title', 'Login Page')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col s12 l8 offset-l2">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Login</span>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">person_outline</i>
                                    <label for="username">Email</label>
                                    <input type="email" required name="email" id="username" value="{{ old('email') }}"
                                        class="@error('email') invalid @enderror autocomplete">
                                    @error('email')
                                        <blockquote>{{ $message }}</blockquote>
                                    @enderror
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <label for="password">Password</label>
                                    <input type="password" required name="password" id="password" value="{{ old('password') }}"
                                        class="@error('password') invalid @enderror autocomplete">
                                    @error('password')
                                        <blockquote>{{ $message }}</blockquote>
                                    @enderror
                                </div>
                                <div class="col s12 ">
                                    <button class="btn ml-5" type="submit">Login</button>
    
                                </div>

                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
@endsection
