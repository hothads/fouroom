@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-3xl">
        <div class="mt-12 bg-white p-6">


            <div class="font-semibold text-xl mb-6">{{ __('Подтвердите ваш адрес электронной почты') }}</div>

            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Ссылка для подтверждения вашего аккаунта отправлена вам на почту.') }}
                    </div>
                @endif

                <p class="mb-3">{{ __('Перед тем как продолжить, пожалуйста, подтвердите ваш адрес электронной почты') }}</p>

                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="font-semibold text-blue-500">{{ __('Отправить ссылку повторно') }}</button>
                </form>
            </div>


        </div>
    </div>
@endsection
