@component('mail::message')
    # Site is Slow

    Your site {{$site->name}} is running a bit slow.

    Thanks,
    {{ config('app.name') }}
@endcomponent
