@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <icon-widget
            color="info"
            text="Tasks"
            count="{{$dashData['tasks']}}"
            icon="fa-tasks"
            event-name="taskCountUpdated"
        ></icon-widget>
    </div>
    <div class="col-md-3">
        <icon-widget
            color="warning"
            text="Sites"
            count="{{$dashData['sites']}}"
            icon="fa-globe"
        ></icon-widget>
    </div>
    <div class="col-md-3">
        <icon-widget
            color="danger"
            text="Galleries"
            count="{{$dashData['galleries']}}"
            icon="fa-globe"
        ></icon-widget>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <site-monitor></site-monitor>
    </div>
</div>
@endsection
