@extends('layouts.app')

@section('content')

    <div class="container mx-auto pt-12 form">

        <h1>Пригласить нового пользователя</h1>

        <form action="/invite" method="POST">
            @csrf
            
            <label for="email">Адрес пользователя</label>
            <input type="email" name="email" >
    
            <button type="submit">Отправить</button>
        </form>

    </div>

@endsection
