@component('profiles.activities.activity')
    @slot('heading')

        <h2>
            {{$user->name}} добавил комментарий к посту
            <a href="{{$activity->subject->thread->path()}}">{{$activity->subject->thread->title}}</a>
        </h2>

        <p>{{$activity->created_at->diffForHumans()}}</p>

    @endslot

    @slot('body')
        <article>{{$activity->subject->body}}</article>
    @endslot
@endcomponent

