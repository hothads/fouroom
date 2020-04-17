@extends('layouts.app')
@section('content')
	<nav class="bg-white flex items-center">
		<div class="text-lg tracking-widest p-6 mr-6">
			Forum
		</div>
<div class="flex w-full justify-between">
		<ul class="topmenu">
			<li><a href="">Channels</a></li>
			<li><a href="">Threads</a>
				<ul class="submenu">
					<li><a href="/threads">All threads</a></li>
					
					@if(auth()->check())
					<li><a href="/threads?by={{auth()->user()->name}}">My threads</a></li>
					<li><a href="/threads/create">New threads</a></li>
					@endif
					
					<li><a href="/threads?popular=1">Popular threads</a></li>
				</ul>
			</li>
			<li><a href="">New Thread</a></li>

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
                      	{{ __('Logout') }}
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
@endsection