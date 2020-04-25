<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';
    protected $guarded = [];

    public function provider(){
        return $this->belongsTo(User::class,'provider_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function client(){
        return $this->belongsTo(User::class,'client_id');
    }

    public function medium(){
        return $this->belongsTo(Medium::class,'medium_id');
    }

    public function document(){
        return $this->hasOne(AppointmentDocument::class,'appointment_id','id');
    }
}
