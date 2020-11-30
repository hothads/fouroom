@extends('layouts.app')
@section('content')

    <div class="container mx-auto">
        <div class="bg-white mt-12 p-6">
            <div class="flex mb-6">
                @forelse($lists as $list)
                    <div class="flex items-center mr-2 border-gray-300 border">
                        <div class="flex bg-gray-100 ">
                            <div class="px-2"><a href="{{$list->path()}}">{{$list->title}}</a></div>
                            <form action="/lists/{{$list->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="px-2" type="submit">x</button>
                            </form>
                        </div>
                    </div>
                @empty
                    no records
                @endforelse
            </div>
            <a class="button-blue" href="/lists/create">Добавить</a>
        </div>
    </div>

@endsection
