@component('mail::message')
    <h1>{{$data['subject']}}</h1>
    <p>{{$data['message']}}</p>

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
