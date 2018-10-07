@component('mail::message')
Today's summary
====

@if(!$data['today_total'] || $data['today_total'] == 0)
No expenses made today. Nice!
@else
You have spend **Rs {{number_format($data['today_total'], 2)}}** today.
<br><br><br>


@component('mail::table')
Category wise expense summary
------
| Category | Amount |
|:---------|:-------|
@foreach($data['category_wise'] as $key => $value)
    | {{$key}} | {{$value}} |
@endforeach

Payment method wise expense summary
------
| Payment method | Amount |
|:---------|:-------|
@foreach($data['payment_method_wise'] as $key => $value)
    | {{$key}} | {{$value}} |
@endforeach

|Description of the entries|
|:---------|
@foreach($data['descriptions'] as $key => $value)
| {{$key + 1}} - {{$value}} |
@endforeach

@endcomponent

@endif

Thanks,
{{ config('app.name') }}
@endcomponent
