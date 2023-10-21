<x-mail::message>
# {{__('mail.hello')}} {{ $user->name }}

{{__('mail.mail_body')}}.

<x-mail::button :url="$url">
{{__('mail.reset_password')}}
</x-mail::button>
<strong>{{__('mail.token')}}</strong>:  {{$token}}<br><br>

{{__('mail.thanks')}},<br>
{{ config('app.name') }}
</x-mail::message>
