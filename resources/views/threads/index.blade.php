@extends('layouts.app')

@section('content')

<div class="container mx-auto my-6">

	<div class="border-b py-6 mb-6">

		<span class="text-2xl">Темы форума</span>

	</div>


		@forelse($threads as $thread)

			<div class="forum-card">

				<div class="forum-header">

					<h2>
                        <a href="{{ $thread->path() }}">
                            @if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                <strong>{{ $thread->title }}</strong>
                            @else
                                {{ $thread->title }}
                            @endif

                        </a>
                    </h2>

					<p>
						<a href="{{$thread->path()}}">
							Ответов: {{$thread->replies_count}}
						</a>
					</p>

				</div>

				<div class="forum-body">

					<article>{!! $thread->body !!}</article>

				</div>

			</div>

	@empty

		no threads

	@endforelse








</div>

@endsection
