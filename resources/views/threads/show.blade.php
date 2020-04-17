@extends('layouts.app')

@section('content')

<div class="container mx-auto flex py-6">
	
	<div class="w-2/3">


		<div class="forum-card">
			
			<div class="forum-header">
				<h2>
					<a href="{{ route('profile', $thread->creator) }}">{{$thread->creator->name}}</a> 
					said {{ $thread->title }}
				</h2>
				
				@can('update', $thread)
				<div>
					<form method="POST" action="{{$thread->path()}}">
						@csrf
						@method('DELETE')
						<button class="text-xs bg-gray-800 text-white font-semibold tracking-widest border border-black px-3 rounded py-1" type="submit">Удалить</button>
					</form>
				</div>
				@endcan

			</div>

			<div class="forum-body">
				<article>{!! $thread->body !!}</article>
			</div>
		
		</div>


		<div>
			@foreach($replies as $reply)
				@include('threads.reply')
			@endforeach

			{{$replies->links()}}

			@if(auth()->check())
				
				<form class="flex flex-col" action="{{ $thread->path().'/replies' }}" method="POST">
					<label class="mb-2 " for="body">Ответить</label>
					<textarea class="mb-3 px-5 py-2" name="body" placeholder="Have something to say?"></textarea>
					<div class="text-left  mb-3">
						<button class="bg-green-500 px-3 py-1 text-white rounded" type="submit">Сохранить</button>
					</div>
					@csrf
				</form>
			
			@else 
				<div class="container mx-auto">
					<p class="text-center">Пожалуйста <a href="/login">авторизуйтесь</a> чтобы принять участие в беседе.</p>
				</div>
			@endif

		</div>

	</div>


<!-- second column -->

	<div class="w-1/3 pl-6">
		<div class="bg-white rounded border-2 border-gray-200 mb-6">
			
			<div class="px-5 py-3"> 
					
				<div class="mb-2">
					<p>Автор: <a href="{{route('profile', $thread->creator)}}">{{$thread->creator->name}}</a></p>
					<p>Опубликовано: {{$thread->created_at->diffForHumans()}}</p>
					<p>Комментариев:{{$thread->replies_count}}</p>
				</div>
					
			</div>
		</div>
	</div>

</div>






@endsection