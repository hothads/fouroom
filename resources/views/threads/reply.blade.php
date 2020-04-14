<div class="container mx-auto my-6 bg-white rounded border-2 border-gray-200">

	<div class="bg-gray-200 px-5 py-3 text-lg flex justify-between">
		<p><a class="text-blue-700" href="{{route('profile', $reply->owner)}}">{{ $reply->owner->name}}</a> said {{ $reply->created_at->diffForHumans() }}</p>
		<form action="/replies/{{ $reply->id }}/favorites" method="POST">
			@csrf
			<button type="submit" {{ $reply->isFavorited() ? 'disabled' : '' }}>{{$reply->getFavoritesCountAttributes()}} like</button>
		</form>
	</div>
	
	<div class="px-5 py-3"> 
			
		<article>
			<div>{{ $reply->body }}</div>
		</article>
			
	</div>
</div>