@extends('layouts.app')
@section('content')

    <div class="container mx-auto max-w-sm">
        <form class="auth_form" action="/lists" method="POST">
            @csrf
            <label for="title">Заголовок нового списка</label>
            <input type="text" name="title">
            <button class="button-blue mt-2">Сохранить</button>
        </form>
    </div>

@endsection
