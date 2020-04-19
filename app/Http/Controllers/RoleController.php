<?php

namespace App\Http\Controllers;

use App\Http\Repositories\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $role;
    public function __construct(RoleRepositoryInterface $role)
    {
        $this->role = $role;
    }

    public function index(Request $request){
        return $this->role->index($request);
    }
    public function create(Request $request){
        return $this->role->create($request);
    }
    public function store(Request $request){
        return $this->role->store($request);
    }
    public function edit(Request $request,$id){
        return $this->role->edit($request,$id);
    }
    public function update(Request $request,$id){
        return $this->role->update($request,$id);
    }
}
