<?php

use Spatie\Permission\Models\Role;

function allRoles(){
    return Role::pluck('name','name')->toArray();
}

function allServices(){
    return \App\Service::where('status',1)->pluck('name','id')->toArray();
}