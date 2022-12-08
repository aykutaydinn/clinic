<?php

use App\Models\User;
use App\Models\Appointment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\PagesController@index');
Route::get('/about', 'App\Http\Controllers\PagesController@about');
Route::get('/contactus', 'App\Http\Controllers\PagesController@contactus');
Route::get('/appointment', 'App\Http\Controllers\PagesController@makeappointment');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout');
Route::post('/appointment/selectdoctor', 'App\Http\Controllers\AppointmentController@selectDoctor');
Route::get('/appointment/selectdoctor', 'App\Http\Controllers\AppointmentController@selectDoctor');
Route::post('/appointment/selectdoctor/book', 'App\Http\Controllers\AppointmentController@bookAppointment');

Auth::routes();

//------PTN-------
Route::group([
    'prefix' => 'patient',
    'as' => 'patient.',
    'namespace' => 'App\Http\Controllers\Patient',
    'middleware' => ['auth', 'patient']
], function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/my-appointments', 'IndexController@myappointments');
    Route::get('/my-details', 'IndexController@mydetails')->name('mydetails');
    Route::get('/my-appointments/{id}','IndexController@showAppointmentDetails');
    Route::post('/updatedetails','IndexController@updateDetails');
    Route::post('/updatepassword','IndexController@updatePassword');
    Route::get('/my-appointments/{id}/{appReason}/{newStatus}','IndexController@updateAppStatus');
    
    Route::delete('/my-appointments/delete/{id}', function ($id) {
        Appointment::findOrFail($id)->delete();;
        return redirect('/patient/my-appointments');
    });
});


//------DOC-------

Route::group([
    'prefix' => 'doctor',
    'as' => 'doctor.',
    'namespace' => 'App\Http\Controllers\Doctor',
    'middleware' => ['auth', 'doctor']
], function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/my-appointments', 'DoctorController@myappointments');
    Route::get('/myavailability', 'DoctorController@myavailability');
    Route::get('/my-appointments/{id}','DoctorController@showAppointmentDetails');
    Route::get('/patientinfo/{acctype}/{id}','DoctorController@showUserDetails');

    Route::post('/editmyavailability','DoctorController@editMyAvailability');
    
    Route::delete('/my-appointments/delete/{id}', function ($id) {
        Appointment::findOrFail($id)->delete();;
        return redirect('/doctor/my-appointments');
    });
});


//-------------------------ADMIN--------------------------------------------

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => ['auth', 'admin']
], function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/manage-admins', 'AdminController@manageadmins');
    Route::get('/manage-appointments', 'AdminController@manageappointments');
    Route::get('/manage-doctors', 'AdminController@managedoctors');
    Route::get('/manage-patients', 'AdminController@managepatients');
    Route::post('/manage-doctors/create', 'AdminController@createdoctor');
    Route::get('/manage-appointments/{id}','AdminController@showAppointmentDetails');
    Route::get('/manage-appointments/changestatus/{id}/{appReason}/{newStatus}','AdminController@updateAppStatus');

    Route::delete('/manage-appointments/delete/{id}', function ($id) {
        Appointment::findOrFail($id)->delete();
        return redirect('/admin/manage-appointments');
    });
    
    
    
    Route::delete('/manage-doctors/delete/{id}', function ($id) {
        User::findOrFail($id)->delete();
        DB::table('doctor_availabilities')->where('doctor_id', $id)->delete();
        DB::table('appointments')->where('doctor_id', $id)->delete();
        return redirect('/admin/manage-doctors');
    });

    Route::delete('/manage-patients/delete/{id}', function ($id) {
        User::findOrFail($id)->delete();
        DB::table('appointments')->where('patient_id', $id)->delete();
        return redirect('/admin/manage-patients');
    });

    Route::delete('/manage-admins/delete/{id}', function ($id) {
        User::findOrFail($id)->delete();
    
        return redirect('/admin/manage-admins');
    });

    Route::get('/manage-doctors/{acctype}/{id}','AdminController@showUserDetails');
    Route::post('/edit/{id}','AdminController@editUser');
    Route::post('/editavailability/{id}','AdminController@editDoctorAvailability');

    Route::get('/manage-patients/{acctype}/{id}','AdminController@showUserDetails');
    Route::post('/edit/{id}','AdminController@editUser');
});
