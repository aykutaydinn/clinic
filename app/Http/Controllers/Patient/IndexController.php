<?php

namespace App\Http\Controllers\Patient;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\DoctorAvailability;
use App\Models\Appointment;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(){
        $id = Auth::id();
        $user = DB::select('select * from users where id = ?',[$id]);
        return view('patient.my-account', compact('user'));
    }

    public function myappointments(){
        $id = Auth::id();
        $appointments = Appointment::with('doctor')->where('patient_id',$id)->where('hidden','0')->get();
        return view('patient.my-appointments', compact('appointments'));
    }

    public function mydetails(){
        $id = Auth::id();
        $user = DB::select('select * from users where id = ?',[$id]);
        return view('patient.my-details', compact('user'));
    }

    public function showAppointmentDetails($id){
        $appointment = Appointment::with('doctor')->where('patient_id', Auth::id())->where('id', $id)->get();
        return view('patient.appointmentdetails', compact('appointment'));
    }

    public function updateDetails(Request $request) {
        try {
        $id = Auth::id();
        $data = $request->input();

        $name = $data['name'];
        $email = $data['email'];
        $dob = $data['dob'];
        $gender = $data['gender'];
        $phone = $data['phone'];
        $chronicDiseases = 'no chronic diseases';
        if(isset($data['chronicDiseases'])){
            $chronicDiseases = $data['chronicDiseases'];
        }
        $address = $data['address'];
        if(isset($data['medicare'])){
            $medicare = $data['medicare'];
            DB::update('update users set name = ?, email = ?, dateOfBirth = ?, gender = ?, phoneNo = ?, medicareNumber = ?, chronicDiseases = ?, address = ? where id = ?',[$name,$email,$dob,$gender,$phone,$medicare,$chronicDiseases,$address,$id]);
        }
        else{
            DB::update('update users set name = ?, email = ?, dateOfBirth = ?, gender = ?, phoneNo = ?, chronicDiseases = ?, address = ? where id = ?',[$name,$email,$dob,$gender,$phone,$chronicDiseases,$address,$id]);
        }
        return redirect()->back() ->with('alert', 'Updates have been done successfully!');
    }catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return redirect()->back() ->with('alert', 'This Medicare Number already registered.');
            }
        }
        
    }

    public function updatePassword(Request $request) {
        $id = Auth::id();
        $data = $request->input();

        $password = Hash::make($data['password']);

        DB::update('update users set password = ? where id = ?',[$password,$id]);
        return redirect()->back() ->with('alert', 'Your password updated successfully!');
        
    }

    public function updateAppStatus($id, $appReason, $newStatus) {
        
        if($appReason == "LongConsultation"){
            $extendedID = $id+1;
            DB::update('update appointments set appType = ? where id = ?',[$newStatus, $id]);
            DB::update('update appointments set appType = ? where id = ?',[$newStatus, $extendedID]);
            return redirect('/patient/my-appointments') ->with('alert', 'Your appointment has been cancelled.');
        }

        else{
            DB::update('update appointments set appType = ? where id = ?',[$newStatus, $id]);
            return redirect('/patient/my-appointments') ->with('alert', 'Your appointment has been cancelled.');
        }
        
    }

    public function testAPI() {

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures?date=2022-04-12",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: api-football-v1.p.rapidapi.com",
		"X-RapidAPI-Key: 0569d85841msh5ea7e48ec65a9e9p1e9229jsnfe638bd4e9e6"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}

        
        return view('patient.my-details', compact('response'));
    }


    
}
