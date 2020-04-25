<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentLog extends Model
{
    protected $table = 'appointment_time_log';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
