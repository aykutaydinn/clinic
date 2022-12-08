@extends('layouts.app')
<link rel="stylesheet" href="/css/appoint.css">

@section('content')

<div class="banner3">
  <div class="py-5 banner" style="background-image:url(https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/form-banners/banner2/banner-bg.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-lg-5">
        @if(isset($error))
<label style="color: red">{{$error}}</label>
@endif
          <h2 style="color: white!important;">Book Appointment</h2>
          <div class="bg-white">
              @auth
            <form action = "/appointment/selectdoctor" method = "post">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<input type = 'hidden' name = 'userid' value = '{{ Auth::user()->id }}'/> 
<input type = 'hidden' name = 'phoneno'value = '{{ Auth::user()->phoneNo }}'/>
              <div class="form-row border-bottom p-4">
                <label class="text-inverse font-12 text-uppercase">Full Name</label>
                <input type = 'hidden' name = 'name' value = '{{ Auth::user()->name }}'/> 
                <input type="text" class="border-0 p-0 font-14 form-control" placeholder="{{ Auth::user()->name }}" readonly/>
              </div>
            <div class="form-row border-bottom p-4">
              <label class="text-inverse font-12 text-uppercase">Email Address</label>
              <input type = 'hidden' name = 'email' value = '{{ Auth::user()->email }}'/>
              <input type="text" class="border-0 p-0 font-14 form-control" placeholder="{{ Auth::user()->email }}" readonly/>
            </div>
            @if(Auth::user()->phoneNo!=null)
            <div class="form-row border-bottom p-4">
              <label class="text-inverse font-12 text-uppercase">Phone Number</label>
              <input type="text" class="border-0 p-0 font-14 form-control" placeholder="{{ Auth::user()->phoneNo }}" readonly/>
            </div>
            @endif
            <div class="form-row border-bottom p-4">
              <label class="text-inverse font-12 text-uppercase">Appointment Type:</label>
                <select id="appType" name="appType" required>
  				        <option value="StandardConsultation">Standard Consultation - 15 min</option>
  				        <option value="LongConsultation">Long Consultation - 30 min</option>
				        </select>
            </div>
            <div class="form-row border-bottom p-4 position-relative">
              <label class="text-inverse font-12 text-uppercase">Booking Date</label>
              <div class="input-group date">
                <input type="date" class="border-0 p-0 font-14 form-control" id="datefield" name="date" required/>
                <label class="mt-2" for="datefield"><i class="icon-calendar mt-1"></i></label>
              </div>
            </div>
            <div class="form-row border-bottom p-4">
              <label class="text-inverse font-12 text-uppercase">Booking Time</label>
              <input class="timepicker" id="timepicker" name="time" placeholder="Select a Time" autocomplete="off" required/>
              <label class="mt-2" for="dp"><i class="fas fa-clock mt-1"></i></label>
            </div>
            <div>
              <button class="m-0 border-0 py-4 font-14 font-weight-medium btn btn-danger-gradiant btn-block position-relative rounded-0 text-center text-white text-uppercase">
									<span>Book Your Appointment Now</span>
							</button>
            </div>
</div>
</form>
@else
<label>You need to login or register in order to book an appointment.</label>
<a href="{{ route('login') }}"> Click here to login or register</a>
@endif
</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(function() {
  var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();
if (dd < 10) {
  dd = '0' + dd
}
if (mm < 10) {
  mm = '0' + mm
}
today = yyyy + '-' + mm + '-' + dd;
document.getElementById("datefield").setAttribute("min", today);

});
</script>

<script>
$('#datefield').change(function() {
  $('input.timepicker').timepicker("destroy");
  document.getElementById('timepicker').value = "";
  var duration = 15;

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();
if (dd < 10) {
  dd = '0' + dd
}
if (mm < 10) {
  mm = '0' + mm
}
today = yyyy + '-' + mm + '-' + dd;
var selectedDate = document.getElementById("datefield");
var d = new Date();
if(today==selectedDate.value)
{
  if(d.getHours()<9)
  var minimumTime = '9:00am';
  else if(d.getHours()>=16){
  var minimumTime = '';
  var errormsg="no time slot";
  }
  else{
  var minimumTime = d.getHours()+':60';
  var errormsg = "";
  }
}
else{
  var minimumTime = '9:00am';
}

if(errormsg === "no time slot"){
      document.getElementById("timepicker").value = "no time slot";
    }
  
  $('input.timepicker').timepicker({
    //timeFormat: 'h:mm p',
    interval: duration,
    minTime: minimumTime,
    maxTime: '4:00pm',
    //default time 9,
    dynamic: false,
    dropdown: true,
    scrollbar: true,
  }).on('keypress', function(e){ e.preventDefault(); });
});
</script>

@endsection