@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="/css/vendor/jquery.atwho.css">
@endsection

@section('content')

    <thread-view :thread="{{ $thread }}" inline-template>
        <div class="container mx-auto flex py-6">
            <div class="w-2/3">
                @include('threads._question')
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
                            <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}" v-if="signedIn">
                            </subscribe-button>
                            <button class="button-red" v-if="authorize('isAdmin')" @click="toggleLock" v-text="locked ? 'Открыть комментарии' : 'Закрыть комментарии'"></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </thread-view>





@endsection
