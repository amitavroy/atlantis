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
                <div class="tile-body">
                    <form action="{{route('expense.index')}}" method="get" class="form-inline">
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Category</div>
                            </div>
                            <select name="cat" class="form-control">
                                <option value="">SELECT</option>
                                @foreach($expenseTypes as $expenseType)
                                    <option value="{{$expenseType->name}}"
                                        {{(request()->has('cat') && request('cat') == $expenseType->name) ? 'selected' : ''}}
                                    >
                                        {{$expenseType->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Method</div>
                            </div>
                            <select name="type" class="form-control">
                                <option value="">SELECT</option>
                                <option value="Cash" {{(request()->has('type') && request('type') == 'Cash') ? 'selected' : ''}}>Cash</option>
                                <option value="Net Banking" {{(request()->has('type') && request('type') == 'Net Banking') ? 'selected' : ''}}>Net Banking</option>
                                <option value="Credit Card" {{(request()->has('type') && request('type') == 'Credit Card') ? 'selected' : ''}}>Credit Card</option>
                            </select>
                        </div>

                        <button class="btn btn-success mr-2">Filter</button>
                        <a href="{{route('expense.index')}}" class="btn btn-primary">Reset</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
