<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\DoctorAvailability;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use DateTime;

class AppointmentController extends Controller
{


    public function selectDoctor(Request $request){
        $data = $request->input();
        if($data!=null){
        $error = '';
        $pId = $data['userid'];
        $pName = $data['name'];
        $pEmail = $data['email'];
        $pPhoneNo = $data['phoneno'];
        $apDate = $data['date'];
        $apTime = $data['time'];
        $apType = $data['appType'];
        $day = Carbon::parse($apDate)->format('l');
        $dateTime = $apDate.' '.$apTime;

        $formattedDateTime = new DateTime($dateTime);
        $strDateTime = $formattedDateTime->format('D, d/m/Y h:i A');


        $availableDoctors = DoctorAvailability::with('doctor')->where($day,'1')->whereNOTIn('doctor_id',function($query) use ($strDateTime) {
            $query->select('doctor_id')->from('appointments')->where('dateOfAppointment', $strDateTime)->where('appType', 'pending');
        })->get();

        if($availableDoctors->isEmpty()){
            $error = 'There is no doctor available in selected date or time. Please try different day/time';
            return view('pages.appointment', compact('error'));
        }
        else{
        return view('pages.selectdoctor', compact('pId','pName','pEmail','pPhoneNo','strDateTime','dateTime','availableDoctors','apType'));
        }
    }
    else{
    return redirect('/appointment');
    }
    }

    public function bookAppointment(Request $request){
        $data = $request->input();

        if ($data['appType'] == "LongConsultation")
        {
        $dateTime = new DateTime($data['dateTime']);
        $strDateTime = $dateTime->format('D, d/m/Y h:i A');
        $appointment = new Appointment();
        $appointment->dateOfAppointment= $strDateTime;
        $appointment->patient_id = $data['pID'];
        $appointment->doctor_id  = $data['selectedDoctor'];
        $appointment->appReason  = $data['appType'];
        $appointment->save();

        $extendedDateTime = new DateTime($data['dateTime']);
        $extendedDateTime->modify('+15 minutes');
        $strExtendedTime = $extendedDateTime->format('D, d/m/Y h:i A');

        $appointmentExtend = new Appointment();
        $appointmentExtend->dateOfAppointment = $strExtendedTime;
        $appointmentExtend->patient_id = $data['pID'];
        $appointmentExtend->doctor_id  = $data['selectedDoctor'];
        $appointmentExtend->appReason  = $data['appType'];
        $appointmentExtend->hidden  = 1;
        $appointmentExtend->save();
        return redirect('/patient/my-appointments')->with('alert', 'You have successfully booked your appointment!');
        }

        else{
        $dateTime = new DateTime($data['dateTime']);
        $strDateTime = $dateTime->format('D, d/m/Y h:i A');
        $appointment = new Appointment();
        $appointment->dateOfAppointment= $strDateTime;
        $appointment->patient_id = $data['pID'];
        $appointment->doctor_id  = $data['selectedDoctor'];
        $appointment->appReason  = $data['appType'];

        $appointment->save();
        return redirect('/patient/my-appointments')->with('alert', 'You have successfully booked your appointment!');
        }
    }
}
