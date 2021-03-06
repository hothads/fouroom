@extends('layouts.app')

@section('content')

    <div class="container max-w-4xl mx-auto mt-6">
        <h1 class="text-2xl font-bold my-6 uppercase">Личный кабинет</h1>
        <div class="inline-block">
            <div class="flex items-center flex-shrink-0 flex-grow-0 bg-white shadow rounded-lg p-5">

                <avatar-form :user="{{ $user }}"></avatar-form>

                <div class="flex flex-col text-gray-700  leading-loose mx-5 text-lg">

                    <span class="font-bold">{{$user->name}}</span>
                    {{-- <span><a class="text-point" href="/threads?by={{$user->name}}"> Все публикации</a></span> --}}

                </div>

                {{--        <h1 class="text-2xl font-bold"> История активности </h1>--}}

                {{--        @forelse($activities as $date => $activity)--}}
                {{--            <div class="border-b py-6 mb-6">--}}
                {{--                <span class="text-2xl">{{$date}}</span>--}}
                {{--            </div>--}}

                {{--            @foreach($activity as $record)--}}
                {{--                @include('profiles.activities.' . $record->type, ['activity'=>$record] )--}}
                {{--            @endforeach--}}
                {{--        @empty--}}

                {{--            <p>Пользователь не совершал никаких действий на форуме</p>--}}

                {{--        @endforelse--}}

            </div>
        </div>

        <h1 class="text-2xl font-bold mt-12"> История рассылок</h1>

        @forelse ($sendlogs as $date => $logs)

            <div class="border-b py-6 mb-6">
                <span class="text-2xl">{{$date}}</span>
            </div>

            @foreach ($logs as $log)

            @if ($log->action == 'Выполнена рассылка')

                <div class="forum-header">
                    <h2>
                        {{$log->action}}
                    </h2>
        
                <p>{{$log->created_at->diffForHumans()}}</p>
                </div>

                <div class="forum-body mb-12">
                    <article class="px-2 pt-4">
                        {!!$log->template_message!!}
                        <div class="flex justify-between mt-3">
                            <p><a href="/lists/{{$log->list_id}}/emails/create">Список рассылки</a></p>
                            <p><a href="/templates/{{$log->template_id}}">Шаблон письма</a></p>
                        </div>
                    </article>
                </div>

            @endif

            @if ($log->email !== null)
                
                <div class="forum-header">
                    <h2>
                        {{$log->action}}
                    </h2>
        
                <p>{{$log->created_at->diffForHumans()}}</p>
                </div>

                <div class="forum-body mb-12">
                    <article>
                        
                    <div class="flex justify-between mt-3">
                        <p><a href="/lists/{{$log->list_id}}/emails/create">Список рассылки</a></p>
                        <p>{{$log->email}}</p>
                        
                    </div>
                    </article>
                </div>
            

            @endif

                

            @endforeach
    
            @empty
            no activity
        @endforelse

    </div>

@endsection
