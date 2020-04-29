@extends('layouts.app')

@section('content')

    <div class="container max-w-4xl mx-auto mt-6">


        @forelse($activities as $date => $activity)

            <div class="border-b py-6 mb-6">

                <span class="text-2xl">{{$date}}</span>

            </div>

            @foreach($activity as $record)
                @include('profiles.activities.' . $record->type, ['activity'=>$record] )
            @endforeach
        @empty

            no threads

        @endforelse

    </div>

@endsection
