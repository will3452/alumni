@extends('layouts.auth')

@section('content')
<div class="flex h-screen w-screen items-center justify-center " style="background: url('/login.jpg'); background-repeat: no-repeat; background-size:cover; background-position:center; ">
    <form method="POST" action="{{ route('login') }}" class="w-1/3 p-6 bg-white rounded-xl bg-opacity-80">
        <h1 class="text-center font-bold text-xl p-2 mb-2">LOGIN</h1>
        @csrf
        <label for="email" class="font-bold">{{ __('Email Address') }}</label>
        <input  id="email" type="email" class="block w-full p-2 rounded-xl @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="block invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <br />
        <label for="password" class="font-bold">{{ __('Password') }}</label>
        <input id="password" type="password" class="block w-full p-2 rounded-xl @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div>
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>

        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif

        <button type="submit" class="w-full p-2 font-bold text-white bg-pink-500 rounded-xl my-4">
            {{ __('Login') }}
        </button>

        <small class="block text-center">
            Dont have an account ? <a href="/register" class="underline">REGISTER</a>
        </small>

    </form>
</div>
@endsection
