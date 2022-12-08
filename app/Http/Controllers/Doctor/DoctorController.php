<?php

namespace App\Http\Controllers\Doctor;

use Auth;
use App\Models\DoctorAvailability;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DoctorController extends Controller
{


    public function myappointments(){

        $id = Auth::id();
        $appointments =  Appointment::with('doctor')->where('doctor_id', $id)->where('hidden','0')->get();
        return view('doctor.my-appointments', compact('appointments'));
    }

    public function showAppointmentDetails($id){
        $appointment = Appointment::with('doctor')->where('doctor_id', Auth::id())->where('id', $id)->get();
        return view('doctor.appointmentdetails', compact('appointment'));
    }

    public function myavailability(){

        $id = Auth::id();
        $availability = DoctorAvailability::with('doctor')->where('doctor_id', $id)->get();
        return view('doctor.myavailability', compact('availability'));
    }

    public function editMyAvailability(Request $request) {
        $id = Auth::id();
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

    public function showUserDetails($acctype,$id){
        $user = DB::select('select * from users where accType = ? AND id = ?',[$acctype, $id]);
        if($user == null){
        $errormsg ='We dont have anyone with this info in our system';
        }
        else{
        $errormsg = null;
        }
        
        return view('doctor.patientinfo', compact('errormsg','user'));
        
        
}
}
