@extends('layouts.app')

@section('content')
	
	<div class="bg-gray-200 px-5 py-3 text-lg">
		<h2>Forum Threads</h2>
	</div>

	<div class="px-5 py-3"> 
			@foreach($threads as $thread)
				<article class="mb-3 border-b-2 pb-4">
					<h4 class="font-semibold ">{{ $thread->title }}</h4>
					<div>{{ $thread->body }}</div>
				</article>
			@endforeach
	</div>
@endsection