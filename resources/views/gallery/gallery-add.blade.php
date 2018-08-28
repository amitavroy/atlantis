@extends('layouts.app')

@section('breadcrumb')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-image"></i> Add a new Gallery</h1>
            <p>Fill the form to create a new Gallery</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">
                    <i class="fa fa-home fa-lg"></i>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('gallery.add')}}">
                    <i class="fa fa-image fa-lg"></i>
                </a>
            </li>
            <li class="breadcrumb-item">Add gallery</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <gallery-add></gallery-add>
        </div>
    </div>
@endsection
