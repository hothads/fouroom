<div class="bg-white border-b">
<div class="container mx-auto">
<nav class="flex items-center">
    <div class="text-lg tracking-widest text-gray-700">
        <img class="p-3" src="/images/logo.svg" alt="">
    </div>

    <div class="flex w-full justify-between">
        <ul class="topmenu">
            <li>
                <a href="/lists">Адресная книга</a>
                <a href="/templates">Шаблоны писем</a>
                <a href="/send">Сделать рассылку</a>
{{--            <li><a href="#">Разделы</a>--}}
{{--                <ul class="submenu-left">--}}
{{--                    @foreach($channels as $channel)--}}
{{--                    <li><a href="/threads/{{$channel->slug}}">{{$channel->slug}}</a></li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li><a href="#">Обсуждения</a>--}}
{{--                <ul class="submenu-left">--}}
{{--                    <li><a href="/threads">Все</a></li>--}}
{{--                    <li><a href="/threads?popular=1">Популярные</a></li>--}}
{{--                    <li><a href="/threads?unanswered=1">Не отвеченные</a></li>--}}
{{--                    @if(auth()->check())--}}
{{--                    <li><a href="/threads?by={{auth()->user()->name}}">Мои</a></li>--}}
{{--                    <li><a href="/threads/create">Добавить</a></li>--}}
{{--                    @endif--}}
{{--                </ul>--}}
            </li>
        </ul>

        @guest

        <ul class="topmenu">
            <li><a href="{{ route('login') }}">Войти</a></li>
            @if (Route::has('register'))
            <li><a href="{{ route('register') }}">Регистрация</a></li>
        </ul>
        @endif

        @else

        <ul class="topmenu">
            <user-notifications></user-notifications>
            <li class="cursor-pointer">{{ Auth::user()->name }}
                <ul class="submenu-right">
                    <li><a href="{{ route('profile', auth()->user()) }}">Личный кабинет</a></li>
                    <li>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Выйти
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>

    @endguest

</div>

</nav>
</div>
</div>
