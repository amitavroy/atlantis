@extends('layouts.app')

@section('breadcrumb')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-money"></i> My Expense stats</h1>
            <p>A quick glance at some reports of my Expenses this month.</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">
                    <i class="fa fa-home fa-lg"></i>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('expense.index')}}">
                    <i class="fa fa-money fa-lg"></i>
                </a>
            </li>
            <li class="breadcrumb-item">Stats</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">Month wise Expense</h3>
                </div>
                <div class="tile-body">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <td><strong>Month</strong></td>
                            <td><strong>Total</strong></td>
                        </tr>
                        @foreach($stats['month-wise'] as $row)
                        <tr>
                            <td>
                                <small class="text-muted">{{$row->ord}}</small>
                                <br>
                                <strong>{{$row->expenseMonth}}</strong>
                            </td>
                            <td>
                                <small class="text-muted">Rs.</small>
                                {{number_format($row->total, 2, '.', ',')}}
                                <br>
                                <small class="text-muted">No. of trans {{$row->trans}}</small>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">Category wise expense</h3>
                </div>
                <div class="tile-body">
                    @foreach($stats['category-wise'] as $key => $row)
                        <h6>{{$key}}</h6>
                        <table class="table table-hover">
                            <tr>
                                <td>Category</td>
                                <td>Total</td>
                            </tr>
                            @foreach($row as $exp)
                            <tr>
                                <td>{{$exp->expCategory}}</td>
                                <td>
                                    <small class="text-muted">Rs.</small> {{number_format($exp->total, 2, '.', ',')}}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title"></h3>
                </div>
                <div class="tile-body">

                </div>
            </div>
        </div>
    </div>
@endsection
