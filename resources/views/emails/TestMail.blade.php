{{--@component('mail::message')--}}

{{--    {{$details['body']}}--}}

{{--    @component('mail::button', ['url' => 'http://tada.ru'])--}}
{{--        View Order--}}
{{--    @endcomponent--}}

{{--    Thanks,<br>--}}
{{--    {{ config('app.name') }}--}}
{{--@endcomponent--}}




<h1>{{$details['title']}}</h1>
<p>{{$details['body']}}</p>
<button>Эта информация была полезана</button>
<p>{{$details['author']}}</p>
<p>{{$details['position']}}</p>



