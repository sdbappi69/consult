<?php

namespace App\Http\Repositories;

use App\Http\Repositories\LoginRepositoryInterface;
use Auth;
use DB;
use Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;
use GuzzleHttp\Client;

class RoleRepository implements RoleRepositoryInterface
{
    public function index($request)
    {
        $req = $request->all();
        $role = Role::paginate(10);
        return view('role.index',compact('role','req'));
    }

    public function create($request)
    {
        $permission = Permission::pluck('name','name')->toArray();
        return view('role.create',compact('permission'));
    }

    public function store($request)
    {
        $role = Role::updateOrCreate([
            'name' => $request->name,
            'guard_name' => $request->guard,
        ]);
        $role->syncPermissions($request->permission);
        session()->flash('successMsg','Role Added.');
        return redirect()->route('role.index');
    }

    public function update($request,$id)
    {
        $role = Role::find($id);
        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard,
        ]);
        $role->syncPermissions($request->permission);
        session()->flash('successMsg','Role Updated.');
        return redirect()->route('role.index');
    }

    public function edit($request,$id)
    {
        $role = Role::find($id);
        $permission = Permission::whereNotIn('id',$role->permissions->pluck('id')->toArray())->pluck('name','id')->toArray();
        return view('role.edit',compact('permission','role'));
    }
}
