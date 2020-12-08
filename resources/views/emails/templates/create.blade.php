@extends('layouts.app')

@section('content')

    <div class="container mx-auto my-6">

        <form id="template" class="flex" method="POST" action="/templates">
            @csrf

           <div class="flex w-full flex-col">

               <label class="block text-sm font-medium text-gray-700">
                   Название шаблона
               </label>

               <input
                   class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                   type="text"
                   name="template_title"
                   rows="1"
                   placeholder="Введите адрес отправителя"
                   value="{{old('template_title')}}">

               @error('template_title')
               <div class="text-sm text-red-500">{{$message}}</div>
               @enderror
{{-- 
                <label class="block text-sm font-medium text-gray-700 mt-6">
                    От кого
                </label>

                <input
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    type="text"
                    name="from"
                    rows="1"
                    placeholder="Введите адрес отправителя"
                    value="{{old('from')}}">

                @error('from')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror --}}

               <label class="block text-sm font-medium text-gray-700 mt-6">
                   Тема сообщения
               </label>

               <input
                   class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                   type="text"
                   name="theme"
                   placeholder="Введите тему сообщения"
                   value="{{old('theme')}}">
               @error('theme')
               <div class="text-sm text-red-500">{{$message}}</div>
               @enderror

                <label class="block text-sm font-medium text-gray-700 mt-6">
                    Заголовок
                </label>

                <input
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    type="text"
                    name="title"
                    placeholder="Введите текст заголовка"
                    value="{{old('title')}}">
                @error('title')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror


                <label class="block text-sm font-medium text-gray-700 mt-6">
                    Текст сообщения
                </label>

                <wysiwyg name="body" value="{{old('body')}}"></wysiwyg> 

                {{-- <textarea name="body"
                          rows="3"
                          class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                          placeholder="Введите текст сообщения">{{old('body')}}</textarea> --}}

                @error('body')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror
            </div>
        </form>

        <div class="py-3 bg-gray-50 text-right mt-6 flex justify-between">
            <button form="template" type="submit" class="button-blue">Сохранить</button>
            <button onclick="location.href='/templates'" class="button-black">Отменить</button>
        </div>
    </div>

@endsection


