@component('mail::message')
From: {{$data['email']}}<br>
Name: {{$data['first_name']}} {{$data['last_name']}}<br>
Name: {{$data['phone']}}<br>
<h1>{{$data['subject']}}</h1>
<p>{{$data['message']}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
