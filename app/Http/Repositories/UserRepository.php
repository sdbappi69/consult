<?php

namespace App\Http\Repositories;

use App\Http\Repositories\LoginRepositoryInterface;
use App\User;
use Auth;
use DB;
use Session;
use Validator;
use GuzzleHttp\Client;

class UserRepository implements UserRepositoryInterface
{
    public function index($request)
    {
        $req = $request->all();
        $users = User::query();
        ($request->f_name ? $users->where('name','like','%'.$request->f_name.'%') : null);
        ($request->f_email? $users->where('email','like','%'.$request->f_email.'%') : null);
        ($request->f_role? $users->whereHas('roles',function($q) use($request){
            return $q->where('name',$request->f_role);
        }) : null);
        $users = $users->paginate(10);

        return view('user.index',compact('users','req'));
    }

    public function store($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'image' => 'mimes:jpeg,png,gif,jpg,webp',
            'role' => 'required|exists:roles,name',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $image = null;
        if ($request->has('image')) {
            if ($request->file('image')) {
                $file = $request->file('image');
                $image = time() . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
                $img_upload_path = 'uploads/';
                $file->move($img_upload_path, $image);
            }
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('12345678'),
            'attributes' => json_encode([
                'image_url' => $image
            ])
        ]);
        $user->syncRoles([$request->role]);
        session()->flash('success','User successfully created!!!');
        return back();
    }

    public function update($request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|exists:roles,name',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::findOrFail($id);
        $image = $user->image;
        if ($request->has('image')) {
            if ($request->file('image')) {
                $file = $request->file('image');
                $image = time() . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
                $img_upload_path = 'uploads/';
                $file->move($img_upload_path, $image);
            }
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'attributes' => json_encode([
                'image_url' => $image
            ])
        ]);
        $user->syncRoles([$request->role]);
        session()->flash('success','User updated successfully!!!');
        return back();
    }

    public function profile($request){
        return view('admin.profile');
    }

    public function profileUpdate($request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required_with:new_password',
            'new_password' => 'min:8',
            'confirm_password' => 'min:8|same:new_password',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = auth()->user();
        if ($request->filled('new_password')) {
            if(Hash::check($request->old_password, $user->password)){
                $user->update([
                    'password' => $request->new_password
                ]);
                session()->flash('success','Password updated.');
                return back();
            } else{
                session()->flash('error', 'Invalid old password.');
                return back();
            }
        }
        else{
            $image = $user->image;
            if (isset($request->image) && $request->file('image')) {
                $avatar = $request->file('image');
                $name = time() . rand(11111, 99999);
                $image =  $name. '.'  . $avatar->getClientOriginalExtension();
                move_uploaded_file($_FILES['image']['tmp_name'],public_path('/uploads/'.$image));
                $user->update([
                    'image' => $image
                ]);
                session()->flash('success','Profile Picture updated.');
                return back();
            }else{
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);
                $user->getInfo()->update([
                    'present_address' => $request->present_address,
                    'parmanent_address' => $request->parmanent_address,
                ]);
                session()->flash('success','Profile updated.');
                return back();
            }
        }
    }
}
