@extends('layouts.app')
<link rel="stylesheet" href="/css/appoint.css">

@section('content')

<div class="banner3">
  <div class="py-5 banner" style="background-image:url(https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/form-banners/banner2/banner-bg.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-lg-5">
          <h2 style="color: white!important;">APPOINTMENT INFORMATION</h2>
          <div class="bg-white">
          <form action = "/appointment/selectdoctor/book" method = "post">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<input type = "hidden" name = "dateTime" value = "{{$dateTime}}">
<input type = "hidden" name = "appType" value = "{{$apType}}">
<input type = "hidden" name = "pID" value = "{{$pId}}">
              <div class="form-row border-bottom p-4">
                <label class="text-inverse font-12 text-uppercase">Appointment Date</label>
                <input type="text" class="border-0 p-0 font-14 form-control" value="{{$strDateTime}}" readonly/>
              </div>
            <div class="form-row border-bottom p-4">
              <label class="text-inverse font-12 text-uppercase">Patient Name</label>
              <input type="text" class="border-0 p-0 font-14 form-control" value="{{$pName}}" readonly/>
            </div>
            <div class="form-row border-bottom p-4">
              <label class="text-inverse font-12 text-uppercase">Patient Email</label>
              <input type="text" class="border-0 p-0 font-14 form-control" value="{{$pEmail}}" readonly/>
            </div>
            @if($pPhoneNo!=null)
            <div class="form-row border-bottom p-4">
              <label class="text-inverse font-12 text-uppercase">Patient Phone Number</label>
              <input type="text" class="border-0 p-0 font-14 form-control" value="{{$pPhoneNo}}" readonly/>
            </div>
            @endif
            <div class="form-row border-bottom p-4 position-relative">
              <label class="text-inverse font-12 text-uppercase">Please choose one of the available doctors</label>
              <div class="input-group date">
              <select name="selectedDoctor" id="selectedDoctor">
@foreach($availableDoctors as $doctor)
<option value="{{ $doctor->doctor->id}} ">{{ $doctor->doctor->name}} - {{$doctor->doctor->doctorType}} </option>
@endforeach
</select>
              </div>
            </div>
            <div>
              <button class="m-0 border-0 py-4 font-14 font-weight-medium btn btn-danger-gradiant btn-block position-relative rounded-0 text-center text-white text-uppercase">
									<span>Confirm Your Appointment Now</span>
							</button>
            </div>
</div>
</form>
</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection