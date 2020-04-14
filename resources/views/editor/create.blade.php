		<form class="flex flex-col" action="/threads" method="POST">
			@csrf

			<label class="mb-1 mt-3" for="channel_id">Channel</label>
			<select class="border border-gray-200 rounded mb-3" name="channel_id" id="channel_id">
				<option>Choose one...</option>
				@foreach($channels as $channel)
					<option value="{{$channel->id}}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{$channel->slug}}</option>
				@endforeach
			</select>


			<label class="mb-1" for="title">Title</label>
			<input class="border border-gray-200 rounded mb-3" type="text" name="title" value="{{ old('title') }}">
			
			

			<label class="mb-1" for="body">Body</label>


			<textarea class="form-control" id="summary-ckeditor" name="body">{{ old('body') }}</textarea>

			{{-- <textarea class="border border-gray-200 rounded mb-3" name="body">{{ old('body') }}</textarea> --}}
			
			<div class="text-left  mb-3">
				<button class="bg-green-500 px-3 py-1 text-white rounded" type="submit">Save</button>
			</div>
		


		@if(count($errors))
		<div class="bg-red-200 p-3 rounded mb-6">
			<p class="text-bg tracking-wider mb-1">Allert</p>
				<ul class="text-sm">
					@foreach($errors->all() as $error)
						<li class="list-disc ml-4">{{$error}}</li>
					@endforeach
				</ul>
		</div>	
		@endif

		</form>









<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace( 'summary-ckeditor', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>