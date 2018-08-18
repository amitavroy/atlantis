@extends('layouts.app')

@section('breadcrumb')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-money"></i> My Expenses</h1>
            <p>A quick glance at my expenses.</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">
                    <i class="fa fa-home fa-lg"></i>
                </a>
            </li>
            <li class="breadcrumb-item">Expenses</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title"></h3>
                    <p>
                        <a class="btn btn-primary icon-btn" href="#"
                           onclick="event.preventDefault(); window.eventBus.$emit('toggleAddExpenseForm')">
                            <i class="fa fa-plus"></i>Add Item	</a>
                    </p>
                </div>
                <div class="tile-body">
                    <expense-add></expense-add>
                    <expense-list :expenses="{{json_encode($viewData)}}"></expense-list>
                    {{$expenses->render()}}
                </div>
            </div>
        </div>
    </div>
@endsection
