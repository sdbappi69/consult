<?php

namespace App\Http\Repositories;

use App\Http\Repositories\LoginRepositoryInterface;
use Auth;
use mysql_xdevapi\Session;
use Spatie\Permission\Models\Permission;
use Validator;
use GuzzleHttp\Client;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function index($request)
    {
        $req = $request->all();
        $permission = Permission::paginate(10);
        return view('permission.index',compact('permission','req'));
    }

    public function store($request)
    {
        Permission::updateOrCreate([
            'name' => $request->name,
            'guard_name' => $request->guard
        ]);
        Session()->flash('successMsg','Permission created');
        return redirect()->route('permission.index');
    }
    public function update($request,$id)
    {
        $permission = Permission::find($id);
        $permission->update([
            'name' => $request->name,
            'guard_name' => $request->guard
        ]);
        session()->flash('successMsg','Permission Updated');
        return redirect()->route('permission.index');
    }
}
