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
                    <expense-add></expense-add>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses as $expense)
                        <tr>
                            <td>{{$expense->description}}</td>
                            <td>
                                {{$expenseTypes->where('id', $expense->expense_type_id)->first()->name}}
                                <br>
                                <small class="text-muted">{{$expense->payment_method}}</small>
                            </td>
                            <td>
                                {{$expense->transaction_date}}
                                <br>
                                <small class="text-muted">by {{$expense->user->name}}</small>
                            </td>
                            <td>
                                <span class="text-muted">Rs</span> {{number_format($expense->amount, 2, '.', ',')}}
                            </td>
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
