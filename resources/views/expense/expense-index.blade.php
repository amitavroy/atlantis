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
                    <p><a class="btn btn-primary icon-btn" href=""><i class="fa fa-plus"></i>Add Item	</a></p>
                </div>
                <div class="tile-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Description</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Payment method</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses as $expense)
                        <tr>
                            <td>{{$expense->description}}</td>
                            <td>{{$expense->user->name}}</td>
                            <td>{{$expense->transaction_date}}</td>
                            <td>{{$expense->amount}}</td>
                            <td>{{$expense->payment_method}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{$expenses->render()}}
                </div>
            </div>
        </div>
    </div>
@endsection
