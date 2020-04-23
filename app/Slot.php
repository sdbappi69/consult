<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $table = 'slots';
    protected $guarded = [];

    public function getProvider(){
        return $this->belongsTo(User::class,'provider_id');
    }
}
