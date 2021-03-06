@forelse($threads as $thread)

    <div class="forum-card">
        <div class="forum-header">
            <div class="flex justify-start items-center">

                <a class="mr-4 flex-shrink-0" href="{{ route('profile', $thread->creator) }}">
                    <img class="rounded-full shadow" src="/storage/{{ $thread->creator->avatar_path }}"
                         alt="{{$thread->creator->name}}" width="50">
                </a>

                <h2>
                    <a href="{{ $thread->path() }}">
                        @if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                            <span class="text-white">{{ $thread->title }}</span>
                        @else
                            {{ $thread->title }}
                        @endif
                    </a>
                </h2>
            </div>
            <div class="forum-icons">

                <div class="forum-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M17 11v3l-3-3H8a2 2 0 01-2-2V2c0-1.1.9-2 2-2h10a2 2 0 012 2v7a2 2 0 01-2 2h-1zm-3 2v2a2 2 0 01-2 2H6l-3 3v-3H2a2 2 0 01-2-2V8c0-1.1.9-2 2-2h2v3a4 4 0 004 4h6z"/>
                    </svg>
                    {{$thread->replies_count}}
                </div>

                <div class="forum-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M.2 10a11 11 0 0119.6 0A11 11 0 01.2 10zm9.8 4a4 4 0 100-8 4 4 0 000 8zm0-2a2 2 0 110-4 2 2 0 010 4z"/>
                    </svg>
                    {{$thread->visits()->count()}}
                </div>
            </div>
        </div>

        <div class="forum-body">
            <article>{!! $thread->body !!}</article>
            <h5>Автор: <a href="{{ route('profile', $thread->creator) }}"> {{ $thread->creator->name }}</a></h5>
        </div>
    </div>

@empty
    Нет записей
@endforelse
