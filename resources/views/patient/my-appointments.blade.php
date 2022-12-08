@extends('layouts.app')
<link rel="stylesheet" href="/css/list.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/js/list.js"></script>
@section('content')
<div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6"><h2>My <b>Appointments</b></h2></div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Appointment Date</th>
                    <th>Doctor</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                @php

                if ($appointment->appType == "completed") 
                $color = "green";
                elseif ($appointment->appType == "cancelled")
                $color = "red";
                elseif ($appointment->appType == "arrived")
                $color = "yellow";
                else
                $color = "";
                
                @endphp
                <tr>
                    <td>{{$appointment->id}}</td>
                    <td>{{$appointment->dateOfAppointment}}</td>
                    <td>{{$appointment->doctor->name}}</td>
                    <td><label style="color: {{ $color }}">{{$appointment->appType}}</label></td>
                    @if($appointment->appType == "pending")
                    <td><a href="/patient/my-appointments/{{ $appointment->id }}" class="btn btn-sm manage">Manage</a></td>
                    @else
                    <td><a href="/patient/my-appointments/{{ $appointment->id }}" class="btn btn-sm manage disabled">Manage</a></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>     
@endsection
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>