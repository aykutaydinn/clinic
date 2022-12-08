<form action="/admin/manage-doctors/create" method="POST">
<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    <input type="hidden" name="accType" value="DOC">
    <table>
	<tr>
	<td>Full Name<label style="color:red;">*</label></td>
	<td><input type='text' name='name' required/></td>
	</tr>
	<tr>
	<td>Doctor Type<label style="color:red;">*</label></td>
	<td><select id="doctorType" name="doctorType">
  				<option value="General Practioner" selected>General Practioner</option>
  				<option value="Physiotherapist">Physiotherapist</option>
  				<option value="Dietitian">Dietitian</option>
  				<option value="Dermatologists">Dermatologists</option>
				</select></td>
	</tr>
	<tr>
	<td>EMail Address<label style="color:red;">*</label></td>
    <td><input type='email' name='email' required/></td>
	</tr>
	<tr>
	<td>Phone Number</td>
	<td><input type="tel" name='phoneno' pattern="^\({0,1}((0|\+61)(2|4|3|7|8)){0,1}\){0,1}( |-){0,1}[0-9]{2}( |-){0,1}[0-9]{2}( |-){0,1}[0-9]{1}( |-){0,1}[0-9]{3}$"/></td>
    </tr>
    <tr>
        <td>Password<label style="color:red;">*</label></td>
        <td><input type="password" name='password' required/></td>
        </tr>

	<tr>
	<td colspan = '2'>
	<input type = 'submit' value = "Add Doctor"/>
	</td>
	</tr>
	</table>



</form>