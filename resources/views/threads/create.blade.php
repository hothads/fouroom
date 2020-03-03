@extends('layouts.app')

@section('content')

<div class="container mx-auto my-6 bg-white rounded border-2 border-gray-200">
	
	<div class="px-5 py-3 text-lg border-b-2">
		<h2 class="tracking-wider">Add Thread</h2>
	</div>

	<div class="px-5"> 
		<form class="flex flex-col" action="/threads" method="POST">
			@csrf
			<label class="mb-1" for="title">Title</label>
			<input class="border border-gray-200 rounded mb-3" type="text" name="title">
			
			

			<label class="mb-1" for="body">Body</label>
			<textarea class="border border-gray-200 rounded mb-3" name="body"></textarea>
			<div class="text-left  mb-3">
				<button class="bg-green-500 px-3 py-1 text-white rounded" type="submit">Save</button>
			</div>
		</form>
	</div>
</div>

@endsection