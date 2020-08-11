@extends('layouts.app')

@section('content')
    <div class="container max-w-sm mx-auto">

        <div class="mt-6 text-center font-medium text-2xl tracking-wider">Авторизация</div>

        <div class="mt-6 px-6 bg-white rounded shadow-lg">

            <form class="auth_form" method="POST" action="{{ route('login') }}">
                @csrf
                <label for="email">E-mail</label>

                <input id="email" type="email" class="@error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                @error('email')
                <span role="alert">{{ $message }}</span>
                @enderror

                <label for="password">Пароль</label>

                <input id="password" type="password" class=" @error('password') is-invalid @enderror"
                       name="password"  autocomplete="current-password">

                @error('password')
                <span role="alert">{{ $message }}</span>
                @enderror

                <div class="flex items-center mt-3 mb-6">

                    <label for="remember" class="mr-3 text-sm text-gray-700">
                        Запомнить меня
                    </label>

                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                </div>

            <div class="flex items-center justify-between">
                <button class="button-blue" type="submit">
                    Войти
                </button>

                @if (Route::has('password.request'))
                    <a class="text-sm cursor-pointer" href="{{ route('password.request') }}">
                        Забыли пароль?
                    </a>
                @endif
            </div>

            </form>
        </div>

    </div>
@endsection
