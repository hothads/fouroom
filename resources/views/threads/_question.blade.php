<!-- Editing the question -->

<div class="forum-card" v-if="editing">

    <div class="forum-body mt-3 ">
        <input class="w-full border-b-2 border-blue-700 pb-3 text-sm" type="text" v-model="form.title">
        <article>
            <textarea rows="6" class="text-sm bg-white w-full mt-3" v-model="form.body"></textarea>
        </article>


    </div>

    <div class="px-3 pb-3 flex">
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
            <a class="mr-4 flex-shrink-0" href="{{ route('profile', $thread->creator) }}">
                <img class="rounded-full shadow" src="/storage/{{ $thread->creator->avatar_path }}"
                     alt="{{$thread->creator->name}}" width="50">
            </a>
            <h2 class="forum-header-title">
                <span v-text="form.title"></span>
            </h2>
        </div>

        <div v-if="authorize('updateThread', thread)">
            <button class="text-white"  @click="editing = true">
                <svg class="w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </button>
        </div>

    </div>



    <div class="forum-body">
        <article v-text="form.body"></article>
        <h5>Автор: <a href="{{ route('profile', $thread->creator) }}"> {{ $thread->creator->name }}</a></h5>
    </div>





</div>
