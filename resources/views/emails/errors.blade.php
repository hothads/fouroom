@extends('layouts.app')

@section('content')
    <div class="container mx-auto">

        <div class="my-16 p-8 bg-white"><h1 class="text-2xl font-bold my-6 uppercase">Cледующие адреса не прошли проверку</h1>
            @foreach($errors as $error)
                <span class="px-2 py-1 border border-gray-300 rounded mr-3">{{$error}}</span>
            @endforeach
            <p class="text-sm mt-6">Пожалуйста, внесите правки в загружаемый файл</p>

        </div>

       <a class="button-blue" href="/emails">Назад</a>

    </div>

@endsection
