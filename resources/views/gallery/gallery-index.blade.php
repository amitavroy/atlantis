@extends('layouts.app')

@section('breadcrumb')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-image"></i> My galleries</h1>
            <p>A quick glance at galleries I have created and that are shared with me.</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">
                    <i class="fa fa-home fa-lg"></i>
                </a>
            </li>
            <li class="breadcrumb-item">Gallery</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <gallery-list :galleries="{{json_encode($galleries)}}"></gallery-list>
        </div>
    </div>
@endsection
