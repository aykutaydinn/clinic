@extends('layouts.admin')

@section('content')
@if($errormsg != null)
{{$errormsg}}
@else
<h1><?php echo $user[0]->accType; ?> Details</h1>
<form action = "/admin/edit/<?php echo $user[0]->id; ?>" method = "post">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<table>
<tr>
<td>Full Name<label style="color:red;">*</label></td>
<td>
<input type = 'text' name = 'name'
value = '<?php echo $user[0]->name; ?>' required/> </td>
</tr>
@if($user[0]->accType == 'DOC')
<tr>
	<td>Doctor Type<label style="color:red;">*</label></td>
	<td><select id="doctorType" name="doctorType">
          <option value="<?php echo $user[0]->doctorType; ?>" hidden><?php echo $user[0]->doctorType; ?></option>
  				<option value="General Practioner">General Practioner</option>
  				<option value="Physiotherapist">Physiotherapist</option>
  				<option value="Dietitian">Dietitian</option>
  				<option value="Dermatologists">Dermatologists</option>
				</select></td>
</tr>
@endif
<tr>
<td>Email<label style="color:red;">*</label></td>
<td>
<input type = 'email' name = 'email'
value = '<?php echo $user[0]->email; ?>' required/>
</td>
</tr>
<tr>
<td>Phone Number</td>
<td>
<input type = 'tel' name = 'phoneno'
value = '<?php echo $user[0]->phoneNo; ?>' pattern="^\({0,1}((0|\+61)(2|4|3|7|8)){0,1}\){0,1}( |-){0,1}[0-9]{2}( |-){0,1}[0-9]{2}( |-){0,1}[0-9]{1}( |-){0,1}[0-9]{3}$"/>
</td>
</tr>
@if($user[0]->accType == 'PTN')
<tr>
	<td>Date of Birth</td>
	<td><input type="date" class="border-0 p-0 font-14 form-control" id="datefield" name="dob" value="{{$user[0]->dateOfBirth}}"/></td>
</tr>
<tr>
	<td>Gender</td>
	<td>
    <select id="gender" name="gender" class="form-control" style="height: 35px;">
                      <option value="<?php echo $user[0]->gender; ?>" hidden><?php echo $user[0]->gender; ?></option>
  				            <option value="Male">Male</option>
  				            <option value="Female">Female</option>
			</select>
  </td>
</tr>
<tr>
	<td>Medicare Number</td>
	<td><input type="number" class="form-control" name='medicare' value="{{$user[0]->medicareNumber}}"></td>
</tr>
<tr>
	<td>Chronic Diseases</td>
	<td><textarea class="form-control" name='chronicDiseases' rows="5">{{$user[0]->chronicDiseases}}</textarea></td>
</tr>
<tr>
	<td>Address</td>
	<td><textarea class="form-control" name='address' rows="5">{{$user[0]->address}}</textarea></td>
</tr>
@endif
<tr>
<td>New Password (Leave empty for no change)</td>
<td>
<input type = 'text' name = 'password'/>
</td>
</tr>
<tr>
<td colspan = '2'>
<input type = 'submit' value = "Update" />
</td>
</tr>
</table>
</form>
@endif
<br> <br>

@if($user[0]->accType == 'DOC')
<h1>Weekly Availability</h1>
<form action="/admin/editavailability/<?php echo $user[0]->id; ?>" method = "post">
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
@endif


<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
@endsection

