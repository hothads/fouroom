@component('profiles.activities.activity')
    @slot('heading')
        <h2>{{$user->name}} опубликовал пост <a href="{{$activity->subject->path()}}">{{$activity->subject->title}}</a>
        </h2>
        <p>{{$activity->created_at->diffForHumans()}}</p>
    @endslot

    @slot('body')
        <article>{!! $activity->subject->body !!}</article>
    @endslot
@endcomponent
