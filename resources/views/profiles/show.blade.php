@extends('layouts.app')

@section('content')

<div class="container max-w-4xl mx-auto">

	<div class="border-b py-6 mb-6">
	
		<span class="text-2xl">{{ $user->name }}</span> 

		{{ $user->created_at->diffForHumans() }} 

	</div>


	@forelse($threads as $thread)
			
			<div class="forum-card">
				
				<div class="forum-header">

					<h2><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h2>
					
					<p>Создано {{$thread->created_at->diffForHumans()}}</p>
				
				</div>

				<div class="forum-body"> 
						
					<article>{!! $thread->body !!}</article>
						
				</div>

			</div>

	@empty

		no threads
	
	@endforelse

	{{$threads->links()}}

</div>
	
@endsection
