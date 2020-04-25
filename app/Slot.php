<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $table = 'slots';
    protected $guarded = [];

    public function getProvider(){
        return $this->hasOneThrough(User::class,CategoryProvider::class,'id','id','category_provider_id','provider_id');
    }
    public function category(){
        return $this->hasOneThrough(Category::class,CategoryProvider::class,'id','id','category_provider_id','category_id');
    }
}
