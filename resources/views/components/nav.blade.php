<div class="bg-white border-b">
<div class="container mx-auto">
<nav class="flex items-center">
    <div class="text-lg w-1/6 tracking-widest text-gray-700 font-semibold py-4 px-6 mr-6">
        Forum test
    </div>

    <div class="flex w-full justify-between">
        <ul class="topmenu">
            <li><a href="#">Каналы</a>
                <ul class="submenu">
                    @foreach($channels as $channel)
                    <li><a href="/threads/{{$channel->slug}}">{{$channel->slug}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="#">Публикации</a>
                <ul class="submenu">
                    <li><a href="/threads">Все</a></li>
                    <li><a href="/threads?popular=1">Популярные</a></li>
                    <li><a href="/threads?unanswered=1">Не отвеченные</a></li>
                    @if(auth()->check())
                    <li><a href="/threads?by={{auth()->user()->name}}">Мои</a></li>
                    <li><a href="/threads/create">Добавить</a></li>
                    @endif
                </ul>
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

            <li><a href="">{{ Auth::user()->name }}</a>
                <ul class="submenu">
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
