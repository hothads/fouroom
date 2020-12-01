@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-6">

        <h1 class="mb-6 text-xl ">Мои подписи</h1>

        @forelse($signatures as $signature)
            <span class="px-2 py-1 border border-gray-300 rounded mr-3"><a href="{{$signature->path()}}">{{$signature->signature_title}}</a></span>
        @empty
            <a class="button-green" href="/signatures/create">Создать новую подпись</a>
        @endforelse
    </div>
@endsection
