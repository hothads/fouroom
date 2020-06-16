@forelse($threads as $thread)

    <div class="forum-card">

        <div class="forum-header">

            <div>

                <h2>
                    <a href="{{ $thread->path() }}">
                        @if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                            <strong>{{ $thread->title }}</strong>
                        @else
                            {{ $thread->title }}
                        @endif

                    </a>
                </h2>
                <h5 class="text-xs">Автор: <a href="{{ route('profile', $thread->creator) }}"> {{ $thread->creator->name }}</a></h5>

            </div>
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
