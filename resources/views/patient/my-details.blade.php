@extends('layouts.app')
<link rel="stylesheet" href="/css/profile.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/js/list.js"></script>
@section('content')
<div class="container light-style flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      Account settings
    </h4>

    <div class="card overflow-hidden">
      <div class="row no-gutters row-bordered row-border-light">
        <div class="col-md-3 pt-0">
          <div class="list-group list-group-flush account-settings-links">
            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane fade active show" id="account-general">

              
              <hr class="border-light m-0">

              <div class="card-body">
              <form action = "/patient/updatedetails" method = "post">
              <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <div class="form-group">
                  <label class="form-label">Full Name*</label>
                  <input type="text" class="form-control mb-1" name='name' value="{{$user[0]->name}}"required/>
                </div>
                <div class="form-group">
                  <label class="form-label">E-mail*</label>
                  <input type="email" class="form-control mb-1" name='email' value="{{$user[0]->email}}"required/>
                </div>
                <div class="input-group date">
                <label class="form-label">Date Of Birth*</label>
                <input type="date" class="border-0 p-0 font-14 form-control" id="datefield" name="dob" value="{{$user[0]->dateOfBirth}}" required/>
              </div>
              <div class="form-group">
                  <label class="form-label">Gender</label>
                    <select id="gender" name="gender" class="form-control" style="height: 35px;">
                      <option value="<?php echo $user[0]->gender; ?>" hidden><?php echo $user[0]->gender; ?></option>
  				            <option value="Male">Male</option>
  				            <option value="Female">Female</option>
				            </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Phone Number</label>
                  <input type = 'tel' name = 'phone' value = '<?php echo $user[0]->phoneNo; ?>' pattern="^\({0,1}((0|\+61)(2|4|3|7|8)){0,1}\){0,1}( |-){0,1}[0-9]{2}( |-){0,1}[0-9]{2}( |-){0,1}[0-9]{1}( |-){0,1}[0-9]{3}$"/>
                </div>
                <div class="form-group">
                  <label class="form-label">Medicare Number (if eligible)</label>
                  <input type="number" class="form-control" name='medicare' value="{{$user[0]->medicareNumber}}">
                </div>
                <div class="form-group">
                  <label class="form-label">Chronic Diseases</label>
                  <textarea class="form-control" name='chronicDiseases' rows="5">{{$user[0]->chronicDiseases}}</textarea>
                </div>
                <div class="form-group">
                  <label class="form-label">Address</label>
                  <textarea class="form-control" name='address' rows="5">{{$user[0]->address}}</textarea>
                </div>
                <label class="form-label">* = Fields Required.</label>
                <input type = 'submit' value = "Update Changes" />
              </form>
              </div>
            

            </div>
            <div class="tab-pane fade" id="account-change-password">
            <form id="passwordform" action = "/patient/updatepassword" method = "post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
              <div class="card-body pb-2">
                <div class="form-group">
                  <label class="form-label">New password</label>
                  <input type="password" class="form-control" name="password" id="pass1" placeholder="Password" required>
                </div>

                <div class="form-group">
                  <label class="form-label">Repeat new password</label>
                  <input type="password" class="form-control" name="password" id="pass2" placeholder="Repeat Password" required>
                </div>
                <input type = 'submit' value = "Update Changes" />
              </div>
              
              </form>
            </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
  @endsection
  <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>

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
document.getElementById("datefield").setAttribute("max", today);

});
</script>

<script>
  $(document).ready(function() {
  $('#passwordform').submit(function(e){
      var form = this;
      e.preventDefault();
      // Check Passwords are the same
      if( $('#pass1').val()==$('#pass2').val() ) {
          form.submit();
      } else {
          alert('Password Mismatch');
          return false;
      }
  });
});
</script>