@extends('layouts.app')

@section('content')
<div class="container max-w-sm mx-auto">

    <div class="mt-6">{{ __('Login') }}</div>

<div class="mt-6 p-3 bg-white rounded">
    
        <form class="flex flex-col" method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">{{ __('E-Mail Address') }}</label>
    
            <input id="email" type="email" class="rounded bg-gray-200 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
            @error('email')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
    
            <label for="password">{{ __('Password') }}</label>
    
            <input id="password" type="password" class="rounded bg-gray-200 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
            @error('password')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="flex items-center mt-3">

                    <label for="remember" class="mr-3">
                        {{ __('Remember Me') }}
                    </label>

                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            

            </div>

            <button class="text-left" type="submit">
                {{ __('Login') }}
            </button>
    
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
        </form>
</div>

</div>
@endsection
