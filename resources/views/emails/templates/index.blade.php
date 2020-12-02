@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-6">

        <h1 class="mb-6 text-xl ">Шаблоны писем</h1>

        <div class="mb-6 ">

            @forelse($templates as $template)
            
            <a class="inline-block mr-3 px-2 py-1 mb-5 shadow rounded bg-white" href="{{$template->path()}}">{{$template->template_title}}</a>
           
            
            @empty

            Еще нет готовых шаблонов
                
            @endforelse

        </div>

        <a class="button-blue" href="/templates/create">Создать новый шаблон</a>
    </div>
@endsection
