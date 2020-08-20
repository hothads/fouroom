
<!-- Editing the question -->

<div class="forum-card" v-if="editing">
    <div class="forum-header">

        <div class="flex w-full justify-start items-center">
            <input class="w-full text-sm rounded py-2 px-3 bg-white" type="text" v-model="form.title">
        </div>

    </div>

    <div class="forum-body">
        <article>
            <textarea class="text-sm rounded py-2 px-3 bg-white w-full" v-model="form.body"></textarea>
        </article>
    </div>

    <div class="p-3 bg-gray-300 flex">
        <button class="button-black-sm" @click="cancel" v-show="editing">Отменить</button>
        <button class="button-black-sm" @click="editing = true" v-show="! editing">Редактировать</button>
        <button class="button-green-sm ml-3" type="submit" @click="update">Сохранить</button>

        @can('update', $thread)
            <div class="flex items-center ml-auto">
                <form method="POST" action="{{$thread->path()}}">
                    @csrf
                    @method('DELETE')
                    <button class="button-red-sm" type="submit">Удалить</button>
                </form>
            </div>
        @endcan
    </div>

</div>

<!-- watching the question -->

<div class="forum-card" v-else>
    <div class="forum-header">
        <div class="flex justify-start items-center">
            <img class="rounded-full mr-3" src="/storage/{{ $thread->creator->avatar_path }}"
                 alt="{{$thread->creator->name}}" width="50" >
            <h2>
                <a href="{{ route('profile', $thread->creator) }}">{{$thread->creator->name}}</a>
                <span v-text="form.title"></span>
            </h2>
        </div>

    </div>

    <div class="forum-body">
        <article v-text="form.body"></article>
    </div>

    <div class="p-3 bg-gray-300" v-if="authorize('updateThread', thread)">
        <button class="button-black-sm" @click="editing = true">Редактировать</button>
    </div>

</div>
