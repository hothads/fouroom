@extends('layouts.app')

@section('content')
<div class="container mx-auto bg-white shadow my-12 rounded-b border-0">
    <div class="flex justify-center">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h2 class="py-12 text-2xl">Вы авторизованы</h2>

    </div>
</div>
@endsection
