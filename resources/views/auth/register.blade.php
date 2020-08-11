@extends('layouts.app')

@section('content')
    <div class="container max-w-sm mx-auto">

        <div class="mt-6 text-center font-medium text-2xl tracking-wider">{{ __('Регистрация') }}</div>

        <div class="mt-6 px-6 bg-white rounded shadow-lg">
            <form class="auth_form" method="POST" action="{{ route('register') }}">
                @csrf

                <label for="name" >{{ __('Имя') }}</label>

                <input
                    id="name"
                    type="text"
                    class="@error('name') is-invalid @enderror"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autocomplete="name"
                    autofocus>

                @error('name')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror


                <label for="email">{{ __('E-Mail') }}</label>


                <input
                    id="email"
                    type="email"
                    class="@error('name') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    required autocomplete="email">

                @error('email')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror




                <label for="password">{{ __('Пароль') }}</label>


                <input
                    id="password"
                    type="password"
                    class="@error('name') is-invalid @enderror"
                    name="password"
                    required autocomplete="new-password">

                @error('password')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror



                <label for="password-confirm"
                >{{ __('Подтвердите пароль') }}</label>


                <input
                    id="password-confirm"
                    type="password"
                    class="@error('name') is-invalid @enderror"
                    name="password_confirmation"
                    required autocomplete="new-password">


                <button class="button-blue mt-10" type="submit">
                    {{ __('Зарегистрироваться') }}
                </button>


            </form>
        </div>




    </div>
@endsection
