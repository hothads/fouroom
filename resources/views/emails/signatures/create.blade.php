@extends('layouts.app')

@section('content')

    <div class="container mx-auto my-6">

        <form class="flex" method="POST" action="/signatures">
            @csrf

            <div class="flex w-full flex-col">

                <label class="block text-sm font-medium text-gray-700 mt-6">
                    Название подписи
                </label>

                <input
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    type="text"
                    name="signature_title"
                    placeholder="Введите название подписи"
                    value="{{old('signature_title')}}">
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
                    value="{{old('name')}}">
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
                    value="{{old('position')}}">
                @error('position')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror


                <div class="py-3 bg-gray-50 text-right mt-6">
                    <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Отправить
                    </button>
                </div>
            </div>

        </form>
    </div>

@endsection


