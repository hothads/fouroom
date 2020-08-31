@extends('layouts.app')

@section('content')

    <search value="{{ request('q') }}">
        @foreach($trending as $thread)
            <p class="bg-white rounded-lg shadow px-4 py-2 mb-2"><a href="{{ $thread->path }}">{{ $thread->title }}</a></p>
        @endforeach
    </search>

@endsection
