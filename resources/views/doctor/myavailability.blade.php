@extends('layouts.doctor')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <h1> My Availability</h1>

                    <form action="/doctor/editmyavailability" method = "post">
                      <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                      <input name="Monday" type="checkbox" value='1' {{ ($availability[0]->Monday == 1 ? 'checked' : '') }}>
                      <label> Monday</label><br>

                      <input name="Tuesday" type="checkbox" value='1' {{ ($availability[0]->Tuesday == 1 ? 'checked' : '') }}>
                      <label> Tuesday</label><br>

                      <input name="Wednesday" type="checkbox" value='1' {{ ($availability[0]->Wednesday == 1 ? 'checked' : '') }}>
                      <label> Wednesday</label><br>

                      <input name="Thursday" type="checkbox" value='1' {{ ($availability[0]->Thursday == 1 ? 'checked' : '') }}>
                      <label> Thursday</label><br>

                      <input name="Friday" type="checkbox" value='1' {{ ($availability[0]->Friday == 1 ? 'checked' : '') }}>
                      <label> Friday</label><br>

                      <input name="Saturday" type="checkbox" value='1' {{ ($availability[0]->Saturday == 1 ? 'checked' : '') }}>
                      <label> Saturday</label><br>

                      <input name="Sunday" type="checkbox" value='1' {{ ($availability[0]->Sunday == 1 ? 'checked' : '') }}>
                      <label> Sunday</label><br>

                      <input type="submit" value="Update"/>
                    </form>        
            </div>
        </div>
    </div>
</div>

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
@endsection