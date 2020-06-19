@extends('layouts.app')

@section('content')

<div class="container mx-auto my-6">

	<div class="border-b py-6 mb-6">

		<span class="text-2xl">Темы форума</span>

	</div>

    <div class="flex">
        <div class="w-2/3 mr-2">

            @include('threads._list')
            {{ $threads->render() }}

        </div>

        <div class="w-1/3">
            <div class="forum-card">
                <div class="forum-header">
                    Trending threads
                </div>

                <div class="forum-body">
                    <div class="border rounded-sm my-2" >
                        @foreach($trending as $thread)
                            <p class="rounded-items"><a href="{{ $thread->path }}">{{ $thread->title }}</a></p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
