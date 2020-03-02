@extends('layouts.app')

@section('content')

<div class="container mx-auto my-6 bg-white rounded border-2 border-gray-200">
	
	<div class="px-5 py-3 text-lg border-b-2">
		<h2 class="tracking-wider">Темы форума</h2>
	</div>

	<div class="px-5"> 
			@foreach($threads as $thread)
				<article class="border-b-2 py-6">
					<h4 class="text-lg pb-2"><a class="text-blue-500" href="{{$thread->path()}}">{{ $thread->title }}</a></h4>
					<div>{{ $thread->body }}</div>
				</article>
			@endforeach
	</div>
</div>

@endsection