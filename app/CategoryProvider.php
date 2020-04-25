<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProvider extends Model
{
    protected $table = 'category_provider';
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function service(){
        return $this->hasOneThrough(Service::class,Category::class,'id','id','category_id','service_id');
    }
}
