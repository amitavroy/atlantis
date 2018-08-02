@extends('layouts.app')

@section('breadcrumb')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> My profile</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">
                    <i class="fa fa-home fa-lg"></i>
                </a>
            </li>
            <li class="breadcrumb-item">Profile</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="tile">
                <form action="{{route('profile.save')}}" method="post">
                <div class="tile-title-w-btn">
                    <h3 class="title">Edit profile</h3>
                    <div class="btn-group">
                        <button class="btn btn-primary" href="#"><i class="fa fa-lg fa-save"></i> Save</button>
                    </div>
                </div>
                <div class="tile-body">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name"
                               class="form-control" value="{{old('name', $user->name)}}">
                        <span class="error-text">{{$errors->first('name')}}</span>
                    </div>

                    <div class="form-group">
                        <label for="name">Email address</label>
                        <input type="email" class="form-control"
                               value="{{old('email', $user->email)}}"
                               disabled title="email">
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" class="form-control"
                               title="password" name="password">
                        <span class="error-text">{{$errors->first('password')}}</span>
                    </div>

                    <div class="form-group">
                        <label for="name">Confirm password</label>
                        <input type="password" class="form-control"
                               title="password" name="confirm_password">
                        <span class="error-text">{{$errors->first('confirm_password')}}</span>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
