@extends('layouts.app')

@section('breadcrumb')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Add Task</h1>
            <p>Add new task to my list.</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">
                    <i class="fa fa-home fa-lg"></i>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('task.index')}}">Tasks</a>
            </li>
            <li class="breadcrumb-item">Add tasks</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="tile">
                <div class="tile-body">
                    <form action="{{route('task.save')}}" method="post">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" class="form-control">
                            <span class="error-text">{{$errors->first('description')}}</span>
                        </div>

                        <button class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
