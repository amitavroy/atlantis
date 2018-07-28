@extends('layouts.app')

@section('breadcrumb')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Tasks</h1>
            <p>A quick glance at things I need to work on.</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">
                    <i class="fa fa-home fa-lg"></i>
                </a>
            </li>
            <li class="breadcrumb-item">Tasks</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">All Tasks ({{$tasks->count()}})</h3>
                    <p>
                        <a class="btn btn-primary icon-btn" href="{{route('task.add')}}">
                            <i class="fa fa-plus"></i>Add Task
                        </a>
                    </p>
                </div>

                <div class="tile-body">
                    <ul class="list-group list-group-flush">
                        @foreach($tasks as $task)
                            <task-item
                                    description="{{$task->description}}" id="{{$task->id}}"
                            ></task-item>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
