

	<div class="forum-card">
		
		<div class="forum-header">
			<h2>
				<a href="{{route('profile', $reply->owner)}}">{{ $reply->owner->name}}</a> 
				said {{ $reply->created_at->diffForHumans() }}
			</h2>

			<form action="/replies/{{ $reply->id }}/favorites" method="POST">
				@csrf
				<button type="submit" {{ $reply->isFavorited() ? 'disabled' : '' }}>{{$reply->getFavoritesCountAttributes()}} like</button>
			</form>
		</div>

		<div class="forum-body">
			<article>{!! $reply->body !!}</article>
		</div>

	</div>



