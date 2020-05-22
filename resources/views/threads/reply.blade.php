{{--<reply :attributes="{{ $reply }}" inline-template v-cloak>--}}

{{--    <div id="reply-{{$reply->id}}" class="forum-card">--}}

{{--        <div class="forum-header">--}}
{{--            <h2>--}}
{{--                <a href="{{route('profile', $reply->owner)}}">{{ $reply->owner->name}}</a>--}}
{{--                said {{ $reply->created_at->diffForHumans() }}--}}
{{--            </h2>--}}
{{--            @if(Auth()->check())--}}
{{--                <favorite :reply="{{$reply}}"></favorite>--}}
{{--            @endif--}}
{{--        </div>--}}


{{--        <div class="forum-body">--}}
{{--            <div class="w-full" v-if="editing">--}}
{{--                <textarea class="w-full rounded border border-gray-300 p-3" v-model="body"></textarea>--}}
{{--                <div class="mt-2">--}}
{{--                    <button class="text-xs rounded bg-blue-700 text-white px-2 py-1 mr-2" @click="update">Обновить--}}
{{--                    </button>--}}
{{--                    <button class="text-xs  text-gray-700 px-2 py-1 mr-2" @click="editing=false">Отменить</button>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <article v-else v-text="body"></article>--}}
{{--        </div>--}}

{{--        <div class="bg-gray-300 p-3 flex">--}}

{{--            <button class="text-xs rounded bg-gray-700 text-white px-2 py-1 mr-2" @click="editing = true">Редактировать--}}
{{--                комментарий--}}
{{--            </button>--}}
{{--            <button class="text-xs rounded bg-red-700 text-white px-2 py-1 mr-2" @click="destroy">Удалить комментарий--}}
{{--            </button>--}}

{{--        </div>--}}
{{--    </div>--}}

{{--</reply>--}}



