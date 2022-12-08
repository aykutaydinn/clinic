@extends('layouts.admin')
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
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Appointment Date</th>
                    <th>Patient Name</th>
                    <th>Doctor</th>
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
                
                
                <tr style="background-color: {{ $color }}">
                    <td>{{$appointment->id}}</td>
                    <td><a href="/admin/manage-appointments/{{ $appointment->id }}">{{$appointment->dateOfAppointment}}</a></td>
                    <td><a href="/admin/manage-patients/{{ $appointment->patient->accType }}/{{ $appointment->patient_id }}">{{$appointment->patient->name}}</a></td>
                    <td><a href="/admin/manage-doctors/{{ $appointment->doctor->accType }}/{{ $appointment->doctor_id }}">{{$appointment->doctor->name}}</a></td>
                    <td>
                    <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: blue; color: #fff">
                    Status
                    </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="/admin/manage-appointments/changestatus/{{ $appointment->id }}/{{ $appointment->appReason }}/completed">Completed</a> <br>
                                    <a class="dropdown-item" href="/admin/manage-appointments/changestatus/{{ $appointment->id }}/{{ $appointment->appReason }}/arrived">Arrived</a> <br>
                                    <a class="dropdown-item" href="/admin/manage-appointments/changestatus/{{ $appointment->id }}/{{ $appointment->appReason }}/cancelled">Cancel</a> <br>
                                    <a class="dropdown-item" href="/admin/manage-appointments/changestatus/{{ $appointment->id }}/{{ $appointment->appReason }}/pending">Pending</a>
                                </div>
                    </div>
                    </td>
                    <td><a href="/admin/manage-appointments/{{ $appointment->id }}" class="btn btn-sm manage">Details</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>     
@endsection
