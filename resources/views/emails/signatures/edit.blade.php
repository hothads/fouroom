@extends('layouts.app')

@section('content')

    <div class="container mx-auto my-6">


    <h1 class="mb-6 text-xl ">Редактирование подписи</h1>

        <form id="deleteForm" action="{{$signature->path()}}" method="POST">
            @csrf
            @method('DELETE')
        </form>

        <form id="updateForm" class="flex" method="POST" action="/signatures/{{$signature->id}}">
            @csrf
            @method('PATCH')

            <div class="flex w-full flex-col">

                <label class="block text-sm font-medium text-gray-700 mt-6">
                    Название подписи
                </label>

                <input
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    type="text"
                    name="signature_title"
                    placeholder="Введите название подписи"
                    value="{{$signature->signature_title}}">
                @error('signature_title')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror

                <label class="block text-sm font-medium text-gray-700 mt-6">
                    Фамилия Имя Отчество
                </label>

                <input
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    type="text"
                    name="name"
                    placeholder="Введите ФИО"
                    value="{{$signature->name}}">
                @error('name')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror

                <label class="block text-sm font-medium text-gray-700 mt-6">
                    Должность
                </label>

                <input
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    type="text"
                    name="position"
                    placeholder="Введите название должности"
                    value="{{$signature->position}}">
                @error('position')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror


                <div class="flex justify-between items-center mt-3">
                    <div class="py-3 bg-gray-50 text-right">

                    </div>
                </div>
            </div>

        </form>

        <div class="flex justify-between mt-6">
            <div>
                <button type="submit" class="button-blue" form="updateForm">Обновить</button>
                <button onclick="location.href='/signatures'" class="button-black">Отменить</button>
            </div>
            <button type="submit" class="button-red" form="deleteForm">Удалить</button>
        </div>
    </div>

@endsection


