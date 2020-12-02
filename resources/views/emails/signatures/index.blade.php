@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-6">

        <h1 class="mb-6 text-xl ">Мои подписи</h1>
        <div class="mb-6 ">
        @forelse($signatures as $signature)
            <a class="inline-block mr-3 px-2 py-1 mb-5 shadow rounded bg-white"  href="{{$signature->path()}}">{{$signature->signature_title}}</a>
        @empty

        Подписи еще не созданы
            
        @endforelse
        </div>

        <a class="button-blue" href="/signatures/create">Создать новую подпись</a>
    </div>
@endsection
