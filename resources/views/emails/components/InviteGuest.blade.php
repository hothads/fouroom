@extends('layouts.app')

@section('content')

    <div class="flex pt-12 form  justify-center">

        <div class="flex bg-white w-1/3 p-6 rounded shadow">

            <h1>Пригласить нового пользователя</h1>

            <form action="/invite" class="auth_form" method="POST">
                @csrf
                
                <label for="email">Адрес пользователя</label>
                <input class="mb-3" type="email" name="email" >
        
                <button class="button-blue" type="submit">Отправить</button>
            </form>

        </div>
    </div>

@endsection
