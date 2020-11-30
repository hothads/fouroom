@extends('layouts.app')

@section('content')
    <div class="container max-w-sm mx-auto pt-12">
        <div class="mt-16">
            <form class="flex flex-row auth_form" action="/emails/{{$email->id}}" method="POST">
                @method('PATCH')
                @csrf
                <label for="email">Email</label>
                <input value="{{$email->email}}" type="text" name="email">
                @error('email')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror

                <label for="user_name">ФИО</label>
                <input value="{{$email->user_name}}" type="text" name="user_name">

                <label for="organisation">Организация</label>
                <input value="{{$email->organisation}}" type="text" name="organisation">

                <label for="source">Источник</label>
                <input value="{{$email->source}}" type="text" name="source">
                <div class="flex justify-between">
                    <button class="button-blue mt-12" type="submit">Сохранить</button>
                    <a href="/lists/{{$email->emaillist->id}}/emails/create" class="button-black mt-12 cursor-pointer">Назад</a>
                </div>
            </form>
        </div>
    </div>
@endsection
