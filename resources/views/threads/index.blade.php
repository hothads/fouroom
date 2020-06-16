@extends('layouts.app')

@section('content')

<div class="container mx-auto my-6">

	<div class="border-b py-6 mb-6">

		<span class="text-2xl">Темы форума</span>

	</div>


@include('threads._list')

{{ $threads->render() }}

</div>

@endsection
