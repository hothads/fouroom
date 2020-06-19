@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="/css/vendor/jquery.atwho.css">
@endsection

@section('content')

    <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>

        <div class="container mx-auto flex py-6">
            <div class="w-2/3">
                <div class="forum-card">
                    <div class="forum-header">
                        <div class="flex justify-start items-center">
                            <img class="rounded-full mr-3" src="/storage/{{ $thread->creator->avatar_path }}"
                                 alt="{{$thread->creator->name}}" width="50" >

                            <h2>
                                <a href="{{ route('profile', $thread->creator) }}">{{$thread->creator->name}}</a>
                                said {{ $thread->title }}
                            </h2>
                        </div>
                        @can('update', $thread)
                            <div class="flex items-center">
                                <form method="POST" action="{{$thread->path()}}">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="text-xs bg-red-600 text-white font-semibold tracking-widest border border-red-700 hover:bg-black hover:border-black px-3 rounded py-1"
                                        type="submit">X
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
                    <replies @removed="repliesCount--" @added="repliesCount++"></replies>
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
                            <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </thread-view>





@endsection
