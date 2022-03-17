@component('mail::message')

    @component('mail::panel')
        Hi, {{ $user->name }}
    @endcomponent

    Thanks,
    {{ config('app.name') }}
@endcomponent
