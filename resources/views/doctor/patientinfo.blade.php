@extends('layouts.doctor')

@section('content')
@if($errormsg != null)
{{$errormsg}}
@else
<h1><?php echo $user[0]->accType; ?> Details</h1>
<form>
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<table>
<tr>
<td>Full Name</td>
<td>
<input type = 'text' name = 'name'
value = '<?php echo $user[0]->name; ?>' readonly/> </td>
</tr>
<tr>
<td>Email</td>
<td>
<input type = 'email' name = 'email'
value = '<?php echo $user[0]->email; ?>' readonly/>
</td>
</tr>
<tr>
<td>Phone Number</td>
<td>
<input type = 'tel' name = 'phoneno'
value = '<?php echo $user[0]->phoneNo; ?>' pattern="^\({0,1}((0|\+61)(2|4|3|7|8)){0,1}\){0,1}( |-){0,1}[0-9]{2}( |-){0,1}[0-9]{2}( |-){0,1}[0-9]{1}( |-){0,1}[0-9]{3}$" readonly />
</td>
</tr>
@if($user[0]->accType == 'PTN')
<tr>
	<td>Date of Birth</td>
	<td><input type="date" class="border-0 p-0 font-14 form-control" id="datefield" name="dob" value="{{$user[0]->dateOfBirth}}" readonly/></td>
</tr>
<tr>
	<td>Gender</td>
	<td>
    <input type = "text" name = 'gender'
    value = '<?php echo $user[0]->gender; ?>' readonly/>
  </td>
</tr>
<tr>
	<td>Medicare Number</td>
	<td><input type="number" class="form-control" name='medicare' value="{{$user[0]->medicareNumber}}" readonly></td>
</tr>
<tr>
	<td>Chronic Diseases</td>
	<td><textarea class="form-control" name='chronicDiseases' rows="5" readonly>{{$user[0]->chronicDiseases}}</textarea></td>
</tr>
<tr>
	<td>Address</td>
	<td><textarea class="form-control" name='address' rows="5" readonly>{{$user[0]->address}}</textarea></td>
</tr>
@endif
</table>
</form>
@endif
<br> <br>


<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
@endsection