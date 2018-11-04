@extends('layouts.app')

@section('breadcrumb')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-image"></i> My Reminders</h1>
            <p>A quick glance at my reminders</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">
                    <i class="fa fa-home fa-lg"></i>
                </a>
            </li>
            <li class="breadcrumb-item">My reminders</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="tile">
                <div class="tile-body">
                    <h4>My reminders</h4>
                    <br>
                    <table class="table table-striped">
                        <tbody>
                        @foreach($reminders as $reminder)
                            <tr>
                                <td style="width: 60%">
                                    <h5>{{$reminder->title}}</h5>
                                </td>
                                <td>
                                    {{$reminder->repeat}}
                                    <br>
                                    <small>{{$reminder->reminder_date}}</small>
                                </td>
                                <td>
                                    {{$reminder->type}}
                                    <br>
                                    {{$reminder->is_active}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="tile">
                <div class="tile-body">
                    <h4>Add a new reminder</h4>
                    <br>
                    <form action="{{route('reminder.save')}}" method="post">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="title" id="description" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="repeat">Repeat</label>
                            <select name="repeat" class="form-control">
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Date</label>
                            <input type="date" name="reminder_date" id="date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" class="form-control">
                                <option value="bill">Bill</option>
                                <option value="birthday">Birthday</option>
                                <option value="meeting">Meeting</option>
                            </select>
                        </div>

                        <button class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
