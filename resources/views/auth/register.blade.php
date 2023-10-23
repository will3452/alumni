@extends('layouts.auth')

@section('content')
<div class="w-full flex">
    <div style="background:url('/register.png');background-size:cover; background-position:center; " class="w-1/2 h-screen bg-red-200 hidden md:block">

    </div>
    <div class="w-full md:w-1/2 p-8 h-screen overflow-y-auto">
        <h1 class="text-center text-2xl uppercase my-4 font-bold text-white bg-pink-400 rounded">Register</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="my-4">
                <label for="name" class="font-bold text-lg">{{ __('Type') }}</label>
                <div class="col-md-6">
                    <select name="type" id="" class="rounded-full p-2 w-full @error('type') border-red-500 @enderror">
                        <option value="Alumni">Alumni</option>
                        <option value="Student">Student</option>
                        <option value="Coordinator">Coordinator</option>
                    </select>
                    @error('type')
                        <span class="text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="my-4">
                <label for="name" class="font-bold text-lg">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="rounded-full p-2 w-full @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="my-4">
                <label for="name" class="font-bold text-lg">{{ __('School Year') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="rounded-full p-2 w-full @error('school_year') border-red-500 @enderror" name="school_year" value="{{ old('school_year') }}" required autocomplete="school_year" autofocus>
                    @error('school_year')
                        <span class="text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="my-4">
                <label for="course" class="font-bold text-lg">{{ __('Course') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="rounded-full p-2 w-full @error('course') border-red-500 @enderror" name="course" value="{{ old('course') }}" required autocomplete="course" autofocus>
                    @error('course')
                        <span class="text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="my-4">
                <label for="email" class="font-bold text-lg">{{ __('Email') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="rounded-full p-2 w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="my-4">
                <label for="Password" class="font-bold text-lg">{{ __('Password') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="rounded-full p-2 w-full @error('password') border-red-500 @enderror" name="password" value="{{ old('password') }}" required>
                    @error('password')
                        <span class="text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="my-4">
                <label for="Password" class="font-bold text-lg">{{ __('Password Confirm') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="rounded-full p-2 w-full @error('password') border-red-500 @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                    @error('password')
                        <span class="text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="text-sm text-center mb-4">
                By submitting this form means that you agree to the <a class="font-bold text-pink-700" href="/terms-n-conditions">terms and conditions</a>.
            </div>
            <button type="submit" class=" w-full p-2 rounded-xl bg-pink-500 font-bold uppercase text-white">
                {{ __('SUBMIT') }}
            </button>
        </form>
    </div>
</div>
@endsection
