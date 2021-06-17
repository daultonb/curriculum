@component('mail::message')


# {{ $title }}

{{ $body }}


Regards,<br>

{{ config('app.name') }}
@endcomponent
