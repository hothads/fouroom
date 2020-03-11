@extends('layouts.app')

@section('content')

<div class="container mx-auto my-6 bg-white rounded border-2 border-gray-200">
	
	<div class="px-5 py-3 text-lg border-b-2">
		<h2 class="tracking-wider">Темы форума</h2>
	</div>

	<div class="px-5"> 
			@foreach($threads as $thread)
				<article class="border-b-2 py-6">
					<div class="flex justify-between">
						<h4 class="text-lg pb-2"><a href="{{$thread->path()}}">{{ $thread->title }}</a></h4>
						<p><a href="{{$thread->path()}}">{{$thread->replies_count}} {{ $thread->replies_count < 2 ? 'reply': 'replies'}}</a></p>
					</div>

					<div>{{ $thread->body }}</div>
				</article>
			@endforeach
	</div>
</div>

@endsection