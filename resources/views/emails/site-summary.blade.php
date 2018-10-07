@component('mail::message')
#Today's summary

@if(!$data['today_total'] || $data['today_total'] == 0)
No expenses made today. Nice!
@else
You have spend **Rs {{number_format($data['today_total'], 2)}}** today.

@component('mail::table')
| Category | Amount |
|:---------|:-------|
@foreach($data['category_wise'] as $key => $value)
| {{$key}} | {{$value}} |
@endforeach

@endcomponent

@endif

Thanks,
{{ config('app.name') }}
@endcomponent
