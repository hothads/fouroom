@extends('layouts.app')
@section('content')

    <div class="container mx-auto my-6">

    <h1 class="mb-6 text-xl ">Адресная книга</h1>
       
            <div class="flex my-6">
                @forelse($lists as $list)
                    <div class="flex mr-3 px-2 py-1 mb-5 shadow rounded bg-white">
                        
                            <div class="px-2"><a href="{{$list->path()}}">{{$list->title}}</a></div>
                            <form action="/lists/{{$list->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="px-2" type="submit">x</button>
                            </form>
                        
                    </div>
                @empty
                    no records
                @endforelse
            </div>
            <a class="button-blue" href="/lists/create">Создать новый список</a>
      
    </div>

@endsection
