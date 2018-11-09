@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <icon-widget
            color="info"
            text="Tasks"
            count="{{dashStats($dashData, 'tasks')}}"
            icon="fa-tasks"
            event-name="taskCountUpdated"
        ></icon-widget>
    </div>
    <div class="col-md-3">
        <icon-widget
            color="warning"
            text="Sites"
            count="{{dashStats($dashData, 'sites')}}"
            icon="fa-globe"
        ></icon-widget>
    </div>
    <div class="col-md-3">
        <icon-widget
            color="danger"
            text="Galleries"
            count="{{dashStats($dashData, 'galleries')}}"
            icon="fa-globe"
        ></icon-widget>
    </div>
    <div class="col-md-3">
        <icon-widget
                color="primary"
                text="Git &#9733;"
                count="{{dashStats($dashData, 'git-stars')}}"
                icon="fa-github"
        ></icon-widget>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <site-monitor></site-monitor>
    </div>

    <div class="col-md-4">
        <git-stats></git-stats>
    </div>

    <div class="col-md-5">
        <reminder-list events="{{dashStats($dashData, 'reminders')}}"></reminder-list>
    </div>
</div>
@endsection
