    <nav class="flex items-center justify-between  flex-wrap bg-white border-b-2 border-gray-200 p-6 tracking-widest">
        <div class="flex items-center flex-shrink-0 mx-12">
            <a class="navbar-brand" href="{{ url('/') }}">
                <h1 class="text-xl">{{ config('app.name', 'Laravel') }}</h1>
            </a>
        </div>
        <div class="block lg:hidden">
            <button class="flex items-center px-3 py-2 border rounded hover:text-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            
            <div class="lg:flex-grow text-sm">
                <a href="/threads" class="block mt-4 lg:inline-block lg:mt-0 mr-4">
                    All Threads
                </a>
{{-- 
                <a href="/threads/replies" class="block mt-4 lg:inline-block lg:mt-0 mr-4">
                    Replies
                </a>

                <a href="/FAQ" class="block mt-4 lg:inline-block lg:mt-0 mr-4">
                    FAQ
                </a> --}}
            </div>


            <div class="mr-12">

                <!-- Authentication Links -->
                @guest
                <a class="ml-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                @if (Route::has('register'))
                <a class="ml-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
                @else
                <a id="navbarDropdown" class="ml-2 dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endguest

        </div>
    </div>
</nav>