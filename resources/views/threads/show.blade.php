@extends('layouts.app')

@section('content')

<div class="container mx-auto flex py-6">
	
	<div class="w-2/3">
		<div class="bg-white rounded border-2 border-gray-200 mb-6">
			
			<div class="bg-gray-200 px-5 py-3 text-lg">
				<h2><a class="text-blue-700" href="/profiles/{{$thread->creator->name}}">{{$thread->creator->name}}</a> said {{ $thread->title }}</h2>
			</div>

			<div class="px-5 py-3"> 
					
				<article class="mb-2">
					<div>{!! $thread->body !!}</div>
				</article>
					
			</div>
		</div>

		<div>
			@foreach($replies as $reply)
				@include('threads.reply')
			@endforeach

			{{$replies->links()}}

			@if(auth()->check())
				
				<form class="flex flex-col" action="{{ $thread->path().'/replies' }}" method="POST">
					<label class="mb-2 " for="body">Reply</label>
					<textarea class="mb-3 px-5 py-2" name="body" placeholder="Have something to say?"></textarea>
					<div class="text-left  mb-3">
						<button class="bg-green-500 px-3 py-1 text-white rounded" type="submit">Save</button>
					</div>
					@csrf
				</form>
			
			@else 
				<div class="container mx-auto">
					<p class="text-center">Please <a href="/login">sign in</a> to participate in this discussion</p>
				</div>
			@endif

		</div>

	</div>


<!-- second column -->

	<div class="w-1/3 pl-6">
		<div class="bg-white rounded border-2 border-gray-200 mb-6">
			
			<div class="px-5 py-3"> 
					
				<div class="mb-2">
					This thread was published {{$thread->created_at->diffForHumans()}} by <a href="#">{{$thread->creator->name}}</a> and currently has {{$thread->replies_count}} comments.
				</div>
					
			</div>
		</div>
	</div>

</div>






@endsection