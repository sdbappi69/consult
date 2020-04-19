<?php

use Spatie\Permission\Models\Role;

function allRoles(){
    return Role::whereNotIn('id',[2,3,4,5,6,7])->pluck('name','name')->toArray();
}