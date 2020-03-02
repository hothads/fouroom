<div class="container mx-auto my-6 bg-white rounded border-2 border-gray-200">

	<div class="bg-gray-200 px-5 py-3 text-lg">
		<p><a class="text-blue-700" href="">{{ $reply->owner->name}}</a> said {{ $reply->created_at->diffForHumans() }}</p>
	</div>
	
	<div class="px-5 py-3"> 
			
		<article>
			<div>{{ $reply->body }}</div>
		</article>
			
	</div>
</div>