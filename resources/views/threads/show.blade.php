@extends('layouts.app')

@section('content')

    <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>

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
                                    <button
                                        class="text-xs bg-gray-800 text-white font-semibold tracking-widest border border-black px-3 rounded py-1"
                                        type="submit">Удалить
                                    </button>
                                </form>
                            </div>
                        @endcan

                    </div>

                    <div class="forum-body">
                        <article>{!! $thread->body !!}</article>
                    </div>

                </div>


                <div>

                    <replies :data="{{ $thread->replies }}"
                             @removed="repliesCount--"
                             @added="repliesCount++"></replies>

                    {{--                @foreach($replies as $reply)--}}
                    {{--                    @include('threads.reply')--}}
                    {{--                @endforeach--}}

                    {{--                {{$replies->links()}}--}}


                </div>

            </div>


            <!-- second column -->

            <div class="w-1/3 pl-6">
                <div class="bg-white rounded border-2 border-gray-200 mb-6">

                    <div class="px-5 py-3">

                        <div class="mb-2">
                            <p>Автор: <a href="{{route('profile', $thread->creator)}}">{{$thread->creator->name}}</a>
                            </p>
                            <p v-text>Опубликовано: {{$thread->created_at->diffForHumans()}}</p>
                            <p>Комментариев: <span v-text="repliesCount"></span></p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </thread-view>





@endsection
