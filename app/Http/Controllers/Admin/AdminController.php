<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\DoctorAvailability;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function manageadmins()
    {
        $users = DB::table('users')->where('accType', 'ADM')->get(); //pass doctors to apppointment view.
        return view('admin.manage-admins', compact('users'));
    }

    public function manageappointments()
    {
        $appointments = Appointment::with('doctor','patient')->where('hidden','0')->get();
        return view('admin.manage-appointments',compact('appointments'));
    }

    public function showAppointmentDetails($id){
        $appointment = Appointment::with('doctor','patient')->where('id', $id)->get();
        return view('admin.appointmentdetails', compact('appointment'));
    }
    
    public function managepatients()
    {
        $users = DB::table('users')->where('accType', 'PTN')->get(); //pass doctors to apppointment view.
        return view('admin.manage-patients', compact('users'));
    }

    public function managedoctors()
    {
        $users = DB::table('users')->where('accType', 'DOC')->get(); //pass doctors to apppointment view.
        return view('admin.manage-doctors', compact('users'));
    }

    public function createdoctor(Request $request)
    {
        $error = 'Entered email address is already in use!';
        try{
        $data = $request->input(); 
        $doctor = new User();
        $doctor->name = $data['name'];
        $doctor->doctorType = $data['doctorType'];
        $doctor->email = $data['email'];
        $doctor->phoneNo = $data['phoneno'];
        $doctor->password = Hash::make($data['password']);
        $doctor->accType = $data['accType'];
        $doctor->save();

        $availability = new DoctorAvailability();
        $availability->doctor_id = $doctor->id;
        $availability->save();

        return redirect()->back() ->with('alert', 'Successfully Added!');
        }
        catch(\Exception $e) {
            return redirect()->back() ->with('alert', 'Error! The email address you have entered is already in use!');
        }
    }

    public function showUserDetails($acctype,$id){
        $user = DB::select('select * from users where accType = ? AND id = ?',[$acctype, $id]);
        $availability = DoctorAvailability::with('doctor')->where('doctor_id', $id)->get();
        if($user == null){
        $errormsg ='We dont have anyone with this info in our system';
        }
        else{
        $errormsg = null;
        }
        
        return view('admin.userdetails', compact('errormsg','user','availability'));
        
        
}

    public function editUser(Request $request,$id) {
        try {
        $data = $request->input();
        $name = $data['name'];
        $email = $data['email'];
        $phoneNo = $data['phoneno'];
        $doctorType = null;
        $gender = null;
        $dob = null;
        $address = null;
        if(isset($data['doctorType'])){
        $doctorType = $data['doctorType'];
        }
        if(isset($data['gender'])){
            $gender = $data['gender'];
        }
        if(isset($data['dob'])){
            $dob = $data['dob'];
        }

        $chronicDiseases = 'no chronic diseases';
        
        if(isset($data['chronicDiseases'])){
            $chronicDiseases = $data['chronicDiseases'];
        }
        if(isset($data['address'])){
            $address = $data['address'];
        }

        if(isset($data['medicare'])){
            $medicare = $data['medicare'];
            if(!isset($data['password'])){
                DB::update('update users set name = ?, email = ?, phoneno = ?, doctorType = ?, gender = ?, dateOfBirth = ?, medicareNumber = ?, chronicDiseases = ?, address = ? where id = ?',[$name,$email,$phoneNo,$doctorType,$gender,$dob,$medicare,$chronicDiseases,$address,$id]);
                }
                else
                {
                $password = Hash::make($data['password']);
                DB::update('update users set name = ?, email = ?, phoneno = ?, password = ?, doctorType = ?, gender = ?, dateOfBirth = ?, medicareNumber = ?, chronicDiseases = ?, address = ? where id = ?',[$name,$email,$phoneNo,$password,$doctorType,$gender,$dob,$medicare,$chronicDiseases,$address,$id]);
                }
        }

        else{
            if(!isset($data['password'])){
                DB::update('update users set name = ?, email = ?, phoneno = ?, doctorType = ?, gender = ?, dateOfBirth = ?, chronicDiseases = ?, address = ? where id = ?',[$name,$email,$phoneNo,$doctorType,$gender,$dob,$chronicDiseases,$address,$id]);
                }
                else
                {
                $password = Hash::make($data['password']);
                DB::update('update users set name = ?, email = ?, phoneno = ?, password = ?, doctorType = ?, gender = ?, dateOfBirth = ?, chronicDiseases = ?, address = ? where id = ?',[$name,$email,$phoneNo,$password,$doctorType,$gender,$dob,$chronicDiseases,$address,$id]);
                }


        }
        return redirect()->back() ->with('alert', 'Updates have been done successfully!');
    }catch (\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062){
            return redirect()->back() ->with('alert', 'This Medicare Number already registered.');
        }
    }
        
    }

    public function editDoctorAvailability(Request $request,$id) {
        $data = $request->input();

        $mon = isset($data['Monday']) ?? '0';
        $tue = isset($data['Tuesday']) ?? '0';
        $wed = isset($data['Wednesday']) ?? '0';
        $thu = isset($data['Thursday']) ?? '0';
        $fri = isset($data['Friday']) ?? '0';
        $sat = isset($data['Saturday']) ?? '0';
        $sun = isset($data['Sunday']) ?? '0';

        DB::update('update doctor_availabilities set Monday = ?, Tuesday = ?, Wednesday = ?, Thursday = ?, Friday = ?, Saturday = ?, Sunday = ? where doctor_id = ?',[$mon,$tue,$wed,$thu,$fri,$sat,$sun,$id]);
        return redirect()->back() ->with('alert', 'Updates have been done successfully!');
        
    }


    public function updateAppStatus($id, $appReason, $newStatus) {
        if($appReason == "LongConsultation"){
            $extendedID = $id+1;
            DB::update('update appointments set appType = ? where id = ?',[$newStatus, $id]);
            DB::update('update appointments set appType = ? where id = ?',[$newStatus, $extendedID]);
            return redirect()->back() ->with('alert', 'Updates have been done successfully!');
        }

        else{
            DB::update('update appointments set appType = ? where id = ?',[$newStatus, $id]);
            return redirect()->back() ->with('alert', 'Updates have been done successfully!');
        }
        
    }
    
        


    
}
