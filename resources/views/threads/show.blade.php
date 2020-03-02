@extends('layouts.app')

@section('content')

<div class="container mx-auto my-6 bg-white rounded border-2 border-gray-200">
	
	<div class="bg-gray-200 px-5 py-3 text-lg">
		<h2><a class="text-blue-700" href="">{{$thread->creator->name}}</a> said {{ $thread->title }}</h2>
	</div>

	<div class="px-5 py-3"> 
			
		<article class="mb-2">
			<div>{{ $thread->body }}</div>
		</article>
			
	</div>
</div>



@foreach($thread->replies as $reply)
	@include('threads.reply')
@endforeach

@if(auth()->check())
	<div class="container mx-auto">
		<form class="flex flex-col" action="{{ $thread->path().'/replies' }}" method="POST">
			<label class="mb-2" for="body">Reply</label>
			<textarea name="body" placeholder="Have something to say?"></textarea>
			<button type="submit">Save</button>
			@csrf
		</form>
	</div>

@else 
	<div class="container mx-auto">
		<p class="text-center">Please <a href="/login">sign in</a> to participate in this discussion</p>
	</div>
@endif

@endsection