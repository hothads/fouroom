@extends('layouts.app')

@section('content')

<div class="container mx-auto">
	<div class="border-b py-6 mb-6">
	
		<span class="text-2xl">{{ $user->name }}</span> 
		Since {{ $user->created_at->diffForHumans() }} 

	</div>



	@forelse($threads as $thread)
			<div class="bg-white rounded border-2 border-gray-200 mb-6">
				
				<div class="bg-gray-200 px-5 py-3 text-lg flex justify-between">
					<h2><a class="text-blue-700" href="">{{ $thread->title }}</a></h2>
					<p class="text-sm">Created {{$thread->created_at->diffForHumans()}}</p>
				</div>

				<div class="px-5 py-3"> 
						
					<article class="mb-2">
						<div>{!! $thread->body !!}</div>
					</article>
						
				</div>
			</div>
	@empty
		no threads
	@endforelse

	{{$threads->links()}}


	
	
</div>
	


	



@endsection
