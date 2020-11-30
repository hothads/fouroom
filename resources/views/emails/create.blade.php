@extends('layouts.app')

@section('content')

    <div class="container mx-auto my-6">

        <form class="flex" method="POST" action="/send">
            @csrf

            <div class="w-1/3 mr-24">

                <label for="country" class="block text-sm font-medium text-gray-700">Адреса получателей</label>

                <select name="lists"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                   @forelse($lists as $list)
                        <option value="{{$list->id}}">{{$list->title}}</option>
                    @empty
                        <option>Списков нет</option>
                    @endforelse
                </select>

                <div class="text-sm mt-2"><a class="text-green-600 underline" href="/lists">Создать новый список адресов
                        получателей</a></div>

            </div>


            <div class="w-2/3 flex flex-col">


                <label class="block text-sm font-medium text-gray-700">
                    Кому
                </label>

                <textarea
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    type="text"
                    name="emails"
                    rows="1"
                    placeholder="Введите адрес получателя"></textarea>

                @error('emails')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror


                <label class="block text-sm font-medium text-gray-700 mt-6">
                    Текст заголовка
                </label>

                <input
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    type="text"
                    name="title"
                    placeholder="Введите текст заголовка">
                @error('title')
                <div class="text-sm text-red-500">{{$message}}</div>
                @enderror

                <label class="block text-sm font-medium text-gray-700 mt-6">

                    Текст сообщения

                </label>

                <textarea name="body" rows="3"
                          class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                          placeholder="Введите текст сообщения"></textarea>

                @error('body')
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
