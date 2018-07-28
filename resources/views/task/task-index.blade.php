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
            <task-group :tasks="{{$tasks}}" url="{{route('task.add')}}"></task-group>
        </div>
    </div>
@endsection
