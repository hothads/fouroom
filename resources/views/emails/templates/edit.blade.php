@extends('layouts.app')

@section('content')

    <div class="container mx-auto my-6">

        <form class="flex" method="POST" action="/templates/{{$template->id}}">
            @csrf
            @method('PATCH')

            <div class="flex w-full flex-col">

                <label class="block text-sm font-medium text-gray-700">
                    Название шаблона
                </label>

                <input
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    type="text"
                    name="template_title"
                    rows="1"
                    value="{{$template->template_title}}">

                @error('template_title')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror

                <label class="block text-sm font-medium text-gray-700 mt-6">
                    От кого
                </label>

                <input
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    type="text"
                    name="from"
                    rows="1"
                    value="{{$template->from}}">

                @error('from')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror

                <label class="block text-sm font-medium text-gray-700 mt-6">
                    Тема сообщения
                </label>

                <input
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    type="text"
                    name="theme"
                    value="{{$template->theme}}">
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
                    value="{{$template->title}}">
                @error('title')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror

                <label class="block text-sm font-medium text-gray-700 mt-6">
                    Текст сообщения
                </label>

                <textarea name="body"
                          rows="3"
                          class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                          >{{$template->body}}</textarea>

                @error('body')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror


                <div class="flex justify-between items-center mt-3">
                    <div class="py-3 bg-gray-50 text-right">
                        <button type="submit" class="button-blue">Обновить</button>
                    </div>

                    <form class="flex" action="{{$template->path()}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button-red">Удалить</button>
                    </form>
                </div>
            </div>

        </form>
    </div>

@endsection


