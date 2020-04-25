<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Service;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $req = $request->all();
        $category = Category::query();
        ($request->f_name ? $category->where('name','like','%'.$request->f_name.'%') : null);
        ($request->f_alias ? $category->where('alias','like','%'.$request->f_alias.'%') : null);
        $category = $category->paginate(10);
        $service = Service::pluck('name','id')->toArray();
        return view('category.index',compact('req','category','service'));
    }

    public function store(CategoryRequest $request){
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
        Category::create([
            'service_id' => $request->service_id,
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
        session()->flash('successMsg','Category successfully created!!!');
        return back();
    }

    public function update(CategoryRequest $request, $id){
        $category = Category::findOrFail($id);
        $old_attr = json_decode($category->attributes);
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
        $category->update([
            'service_id' => $request->service_id,
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
        session()->flash('successMsg','Category updated successfully!!!');
        return back();
    }
}
