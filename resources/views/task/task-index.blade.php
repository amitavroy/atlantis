@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card card-default">
                    <div class="card-header">Actions</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="{{route('task.add')}}">Add new Task</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">
                        <strong>My tasks</strong>
                        <span class="pull-right">{{$tasks->count()}}</span>
                    </div>

                    <ul class="list-group list-group-flush">
                        @foreach($tasks as $task)
                            <task-item
                                description="{{$task->description}}"
                            ></task-item>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
