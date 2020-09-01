@extends('layouts.app')

@section('content')

    <div class="container mx-auto my-6">

        <div class="flex items-center justify-between py-6 mb-6">

            <form class="flex w-full items-center" action="/threads/search" method="GET">
                <input class=" border border-blue-300 rounded w-full px-3 py-2"
                       type="text"
                       placeholder="Что будем искать?"
                       name="q">
            </form>

        </div>

        <div class="flex">
            <div class="w-2/3 mr-12">

                @include('threads._list')
                {{ $threads->render() }}

            </div>

            <div class="w-1/3">

                <div>
                    <h3 class="font-bold text-xl mb-3 pt-3">Популярное</h3>

                    @foreach($trending as $thread)
                        <p class="bg-white rounded-lg shadow px-4 py-2 mb-2"><a
                                href="{{ $thread->path }}">{{ $thread->title }}</a></p>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

@endsection
