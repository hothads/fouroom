@extends('layouts.app')
@section('content')



    <div class="container mx-auto max-w-sm form">
        <h1>Добавить адресную книгу</h1>
        <form class="auth_form" action="/lists" method="POST">
            @csrf
            <label for="title">Заголовок нового списка</label>
            <input type="text" name="title">

            @error('title')
            <div class="text-sm text-red-500">{{$message}}</div>
            @enderror

            <button class="button-blue mt-2">Сохранить</button>
        </form>
    </div>

@endsection
