<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryProvider;
use App\Http\Requests\CategoryProviderRequest;
use Validator;
use Illuminate\Http\Request;

class CategoryProviderController extends Controller
{
    public function index(Request $request){
        $req = $request->all();
        $available_category_lsit = Category::where('status',1)
            ->where('service_id',(json_decode(auth()->user()->attributes)->service_id))
            ->pluck('name','id')->toArray();
        $category = CategoryProvider::with('category')->paginate(10);
        return view('category-provider.index',compact('req','category','available_category_lsit'));
    }

    public function requestList(Request $request){
        $req = $request->all();
        $available_category_lsit = Category::where('status',0)
            ->pluck('name','id')->toArray();
        $category = CategoryProvider::with('category')->where('status',0)->paginate(10);
        return view('category-provider.request_index',compact('req','category','available_category_lsit'));
    }

    public function store(CategoryProviderRequest $request){
        CategoryProvider::create([
            'category_id' => $request->category_id,
            'provider_id' => auth()->user()->id,
            'created_by' => auth()->user()->id,
            'status' => 0,
            'attributes' => json_encode([
                'min_per_slot' => $request->min_per_slot,
                'fee_per_slot' => $request->fee_per_slot,
                'service_charge_per_slot' => null
            ])
        ]);
        session()->flash('successMsg','Your category request successfully send. Please wait for confirmation.');
        return back();
    }

    public function update(CategoryProviderRequest $request, $id){
        $category = CategoryProvider::findOrFail($id);
        $old_attribute = $category->attributes;
        $category->update([
            'category_id' => $request->category_id,
            'updated_by' => auth()->user()->id,
            'status' => ($request->status ?? 0),
            'attributes' => json_encode([
                'min_per_slot' => $request->min_per_slot,
                'fee_per_slot' => $request->fee_per_slot,
                'service_charge_per_slot' => $request->service_charge_per_slot,
                'history' => $old_attribute
            ])
        ]);
        if($request->filled('service_charge_per_slot')){
            session()->flash('successMsg','Category request successfully approved.');
        }
        else{
            session()->flash('successMsg','Your category request successfully updated and send. Please wait for confirmation.');
        }
        return back();
    }
}
