@extends('layouts.app')

@section('breadcrumb')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-image"></i> Gallery {{$gallery->name}}</h1>
            <p>{{$gallery->description}}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">
                    <i class="fa fa-home fa-lg"></i>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('gallery.index')}}">
                    <i class="fa fa-image fa-lg"></i>
                </a>
            </li>
            <li class="breadcrumb-item">View</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <div class="tile">
                    <div class="tile-body">
                        <gallery-view :images="{{json_encode($gallery->photos)}}"></gallery-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
