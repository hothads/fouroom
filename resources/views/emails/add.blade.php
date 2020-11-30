@extends('layouts.app')

@section('content')

    <div class="container mx-auto pt-12">
        <h1 class="text-2xl font-bold my-6 uppercase">Добавить новые адресса для рассылки "{{$list->title}}"</h1>
        <div class="flex w-full ">
            <div class="flex w-full bg-white px-6 rounded shadow">
                <form action="/lists/{{$list->id}}/emails" method="POST">
                    @csrf
                    <div class="flex justify-between w-full">
                        <div class="auth_form pr-2 ">
                            <label for="email">Email</label>
                            <input type="text" name="email">
                        </div>
                        <div class="auth_form pr-2 ">
                            <label for="">ФИО</label>
                            <input type="text" name="user_name">
                        </div>

                        <div class="auth_form pr-2 ">
                            <label for="">Организация</label>
                            <input type="text" name="organisation">
                        </div>

                        <div class="auth_form">
                            <label for="">Источник</label>
                            <input type="text" name="source">
                        </div>
                    </div>

                    <button class="button-blue mt-6" type="submit">
                        Добавить
                    </button>
                </form>
            </div>

            <div class="flex rounded ml-6 pt-6">
                <div class="flex items-center flex-col">
                    <form  action="/lists/{{$list->id}}/emails/import" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="mb-1 font-bold text-gray-700 text-sm mt-6" for="file">Загрузка xlsx</label>
                        <input class="py-2" type="file" name="file">
                        @error('file')
                        <div class="text-sm text-red-500">{{$message}}</div>
                        @enderror
                        <button class="button-blue mt-6" type="submit">Загрузить</button>
                    </form>
                </div>
            </div>

        </div>

        @include('emails.components.list')

    </div>

@endsection
