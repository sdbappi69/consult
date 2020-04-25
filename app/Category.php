<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [];
    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
}
