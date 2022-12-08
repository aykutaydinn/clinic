@extends('layouts.doctor')
<style> 
.col-form-label {
    color: #2A4A8D;
    font-family: Lato,"helvetica neue",sans-serif;
}

.col-form-title {
    color: #2A4A8D;
    font-family: Lato,"helvetica neue",sans-serif;
    font-weight: 400;
    font-variant: small-caps;
}
</style>
@section('content')
<div class="container">

<!-- Form Name -->
<h1>Appointment Details</h1>

<!-- Text input-->
<div class="form-group row">
  <label class="col-md-4 col-form-label">Reference Number</label>  
  <div class="col-md-4">
  <label>{{$appointment[0]->id}}</label>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group row">
  <label class="col-md-4 col-form-label" for="preferred_name">Date:</label>  
  <div class="col-md-4">
  <label>{{$appointment[0]->dateOfAppointment}}</label>
    
  </div>
</div>

<div class="form-group row">
  <label class="col-md-4 col-form-label" for="Patient Name">Patient Name:</label>  
  <div class="col-md-4">
  <label>{{$appointment[0]->patient->name}}</label>
    
  </div>
</div>

<div class="form-group row">
  <label class="col-md-4 col-form-label" for="given_names">Appointment Type:</label>  
  <div class="col-md-4">
  <label>{{$appointment[0]->appReason}}</label>
    
  </div>
</div>

<div class="form-group row">
  <label class="col-md-4 col-form-label" for="given_names">Appointment Status:</label>  
  <div class="col-md-4">
  <label>{{$appointment[0]->appType}}</label>
    
  </div>
</div>

<div class="form-group row">
<form action="/doctor/patientinfo/{{ $appointment[0]->patient->accType }}/{{ $appointment[0]->patient_id }}">
  <label class="col-md-4 col-form-label" for="next"></label>
  <div class="col-md-4">
    <button class="btn btn-primary">Patitent Details</button>
  </div>
</form>
</div>


</div>
@endsection