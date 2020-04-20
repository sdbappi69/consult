<?php

namespace App\Http\Repositories;

use App\Http\Repositories\LoginRepositoryInterface;
use App\Service;
use Validator;
use GuzzleHttp\Client;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function index($request)
    {
        $req = $request->all();
        $service = Service::query();
        ($request->f_name ? $service->where('name','like','%'.$request->f_name.'%') : null);
        ($request->f_alias ? $service->where('alias','like','%'.$request->f_alias.'%') : null);
        $service = $service->paginate(10);

        return view('service.index',compact('service','req'));
    }

    public function store($request)
    {
        $validator = Validator::make($request->all(), [
            'alias' => 'required | unique:services,alias',
            'name' => 'required|unique:services,name',
            'image' => 'mimes:jpeg,png,gif,jpg,webp',
            'icon' => 'mimes:jpeg,png,gif,jpg,webp,ico',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $image = null;
        $icon = null;
        if ($request->has('image')) {
            if ($request->file('image')) {
                $file = $request->file('image');
                $image = time() . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
                $img_upload_path = 'uploads/';
                $file->move($img_upload_path, $image);
            }
        }
        if ($request->has('icon')) {
            if ($request->file('icon')) {
                $file = $request->file('icon');
                $icon = time() . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
                $img_upload_path = 'uploads/';
                $file->move($img_upload_path, $icon);
            }
        }
        $service = Service::create([
            'name' => $request->name,
            'alias' => $request->alias,
            'created_by' => auth()->user()->id,
            'attributes' => json_encode([
                'image_url' => $image,
                'icon_url' => $icon,
                'fa_icon' => $request->fa_icon,
                'description' => $request->description,
                'history' => []
            ])
        ]);
        session()->flash('successMsg','Service successfully created!!!');
        return back();
    }

    public function update($request,$id)
    {
        $validator = Validator::make($request->all(), [
            'alias' => 'required | unique:services,alias,'.$id,
            'name' => 'required|unique:services,name,'.$id,
            'image' => 'mimes:jpeg,png,gif,jpg,webp',
            'icon' => 'mimes:jpeg,png,gif,jpg,webp,ico',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $service = Service::findOrFail($id);
        $old_attr = json_decode($service->attributes);
        $image = $old_attr->image_url;
        $icon = $old_attr->icon_url;
        if ($request->has('image')) {
            if ($request->file('image')) {
                $file = $request->file('image');
                $image = time() . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
                $img_upload_path = 'uploads/';
                $file->move($img_upload_path, $image);
            }
        }
        if ($request->has('icon')) {
            if ($request->file('icon')) {
                $file = $request->file('icon');
                $icon = time() . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
                $img_upload_path = 'uploads/';
                $file->move($img_upload_path, $icon);
            }
        }
        $service->update([
            'name' => $request->name,
            'alias' => $request->alias,
            'updated_by' => auth()->user()->id,
            'attributes' => json_encode([
                'image_url' => $image,
                'icon_url' => $icon,
                'fa_icon' => $request->fa_icon,
                'description' => $request->description,
                'history' => $old_attr
            ])
        ]);
        session()->flash('successMsg','Service updated successfully!!!');
        return back();
    }
}
