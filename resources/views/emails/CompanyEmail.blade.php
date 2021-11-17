@component('mail::message')
<h3>Your Company has been registered at thi email : <span class="text-info">{{ $email }}</span></h3>
@component('mail::button', ['url' => $url])
Sign In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
