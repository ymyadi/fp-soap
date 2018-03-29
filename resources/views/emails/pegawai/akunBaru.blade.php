@component('mail::message')

<p>Berikut Account Login anda :</p>
<p>Username : {{$content['username']}}</p>
<p>Password : {{$content['password']}}</p>

@if(isset($content['url']))
@component('mail::button', ['url' => ''])
Verification
@endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
