<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PermissionRepositoryInterface;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $permission;

    public function __construct(PermissionRepositoryInterface $permission)
    {
        $this->permission = $permission;
    }

    public function index(Request $request){
        return $this->permission->index($request);
    }

    public function create(Request $request){
        return $this->permission->create($request);
    }
    public function store(Request $request){
        return $this->permission->store($request);
    }
    public function edit(Request $request,$id){
        return $this->permission->edit($request,$id);
    }
    public function update(Request $request,$id){
        return $this->permission->update($request,$id);
    }
}
