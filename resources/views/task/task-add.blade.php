@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-centre">
            <div class="col-md-4">
                <div class="card card-default">
                    <div class="card-header">Add new task</div>

                    <div class="card-body">
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
    </div>
@endsection
