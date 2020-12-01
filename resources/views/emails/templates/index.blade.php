@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-6">

        <h1 class="mb-6 text-xl ">Шаблоны писем</h1>

        @forelse($templates as $template)
            <span class="px-2 py-1 border border-gray-300 rounded mr-3"><a href="{{$template->path()}}">{{$template->template_title}}</a></span>
        @empty
            <a class="button-green" href="/templates/create">Создать новый шаблон</a>
        @endforelse
    </div>
@endsection
