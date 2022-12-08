@extends('layouts.app')
@section('content')
<div class="signup">
<div class="appointmentcontainer">
<h1>APPOINTMENT INFORMATION</h1> <br><br>
{{$dateDayTime}}<br>
Patient Name: {{$pName}}  <br>
Patient Email: {{$pEmail}} <br>
@if($pPhoneNo!=null)
Patient Phone: {{$pPhoneNo}} <br><br><br>
@endif
<label>Please choose one of the available GP's </label> <br><br>
<label>Available Doctors  |  </label>
<form action = "/appointment/selectdoctor/book" method = "post">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<input type = "hidden" name = "dateTime" value = "{{$dateTime}}">
<input type = "hidden" name = "pID" value = "{{$pId}}">
<select name="selectedDoctor" id="selectedDoctor">
@foreach($availableDoctors as $doctor)
<option value="{{ $doctor->doctor->id}} ">{{ $doctor->doctor->name}} </option>
@endforeach
</select>
<input type = 'submit' value = "Book Appointment" />
</form>
</div>
</div>
@endsection