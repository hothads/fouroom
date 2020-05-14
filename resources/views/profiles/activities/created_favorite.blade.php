@component('profiles.activities.activity')
    @slot('heading')

        <h2>
            <a href="{{$activity->subject->favorited->path()}}">
                {{$user->name}} оценил комментарий к посту
            </a>
{{--            <a href="{{$activity->subject->thread->path()}}">{{$activity->subject->thread->title}}</a>--}}
        </h2>

        <p>{{$activity->created_at->diffForHumans()}}</p>

    @endslot

    @slot('body')
        <article>{{$activity->subject->favorited->body}}</article>
    @endslot
@endcomponent

