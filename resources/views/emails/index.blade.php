@extends('layouts.app')

@section('content')

    <div class="container mx-auto pt-12">

        <h1 class="text-2xl font-bold my-6 uppercase">Добавить новые адресса для рассылки</h1>

        <div class="flex -mx-2">

            @include('emails.components.addEmail')

            @include('emails.components.import')

        </div>

        @include('emails.components.list')

    </div>

@endsection
