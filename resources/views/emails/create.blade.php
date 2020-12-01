@extends('layouts.app')

@section('content')

    <div class="container mx-auto my-6">

        <form class="flex" method="POST" action="/send">
            @csrf

            <div>

                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mt-6">Адреса получателей</label>

                    <select name="list"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Выберите получателей</option>
                        @forelse($lists as $list)
                            <option value="{{$list->id}}">{{$list->title}}</option>
                        @empty
                            <option>Списков нет</option>
                        @endforelse
                    </select>

                    @error('list')
                    <div class="text-sm text-red-500">{{$message}}</div>
                    @enderror

                    <div class="text-sm mt-2"><a class="text-green-600 underline" href="/lists">Создать новый список
                            адресов
                            получателей</a></div>
                </div>

                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mt-6">Шаблоны писем</label>

                    <select name="template"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Выберите шаблон письма</option>
                        @forelse($templates as $template)
                            <option value="{{$template->id}}">{{$template->title}}</option>
                        @empty
                            <option>Списков нет</option>
                        @endforelse
                    </select>

                    @error('template')
                    <div class="text-sm text-red-500">{{$message}}</div>
                    @enderror

                    <div class="text-sm mt-2"><a class="text-green-600 underline" href="/templates/create">Создать новый
                            шаблон</a></div>
                </div>

                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mt-6">Выбрать подпись</label>

                    <select name="signature"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Выберите подпись</option>
                        @forelse($signatures as $signature)
                            <option value="{{$signature->id}}">{{$signature->signature_title}}</option>
                        @empty
                            <option>Списков нет</option>
                        @endforelse
                    </select>

                    @error('signature')
                    <div class="text-sm text-red-500">{{$message}}</div>
                    @enderror

                    <div class="text-sm mt-2"><a class="text-green-600 underline" href="/templates/create">Создать новый
                            шаблон</a></div>
                </div>

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
