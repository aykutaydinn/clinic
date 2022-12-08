<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAvailability extends Model
{
    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
