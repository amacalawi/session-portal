@component('mail::message')
Hello **{{$name}}**,  {{-- use double space for line break --}}

{!! nl2br($message) !!}

Click below to start working right now
@component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent

@endcomponent