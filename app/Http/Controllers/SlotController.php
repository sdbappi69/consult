<?php

namespace App\Http\Controllers;

use App\CategoryProvider;
use App\Http\Requests\SlotRequest;
use App\Slot;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function index(Request $request){
        $req = $request->all();
        $appointment = Slot::with('getProvider')->wherehas('getProvider',function ($query){
            return $query->where('provider_id',auth()->user()->id);
        });
        ($request->f_date ? $appointment->where('date',$request->f_date) : null);
        $appointment = $appointment->paginate(10);
        $service_category = CategoryProvider::with('category')->where('provider_id',auth()->user()->id)->get()->pluck('category.name','id')->toArray();
        return view('slot.index',compact('appointment','req','service_category'));
    }

    public function store(SlotRequest $request){
        $to = Carbon::createFromFormat('h:i A', $request->time_from);
        $from = Carbon::createFromFormat('h:i A', $request->time_to);
        $diff_in_minutes = $to->diffInMinutes($from);
        $total_slot = $diff_in_minutes/$request->slot_duration;
        if(is_float($total_slot)){
            session()->flash('errorMsg','Please set proper slot duration time and appointment total time.');
            return back();
        }
        $slots = [];
        for ($i = 0 ; $i < $total_slot ; $i++){
            array_push($slots,[
               'start' => $to->format('h:i A'),
                'end' => $to->addMinute($request->slot_duration)->format('h:i A'),
                'duration' => $request->slot_duration
            ]);
        }
        Slot::create([
           'category_provider_id' => $request->category_provider_id,
           'date' => date('Y-m-d',strtotime($request->date)),
           'status' => $request->status,
           'created_by' => auth()->user()->id,
            'attributes' => json_encode([
                'description' => $request->description,
                'available_slots' => json_encode($slots),
                'booked_slots' => json_encode([])
            ])
        ]);
        session()->flash('successMsg','Appointment added for date '.$request->date);
        return back();
    }

    public function update(SlotRequest $request, $id){
        $slot = Slot::FindOrFail($id);
        $old_attribute = json_decode($slot->attributes);
        $update_validator_date = Carbon::now()->addDay(2)->format('Y-m-d');
        if($slot->date <= $update_validator_date){
            session()->flash('errorMsg','You can update only schedules that are two days after from now.');
            return back();
        }
        $to = Carbon::createFromFormat('h:i A', $request->time_from);
        $from = Carbon::createFromFormat('h:i A', $request->time_to);
        $diff_in_minutes = $to->diffInMinutes($from);
        $total_slot = $diff_in_minutes/$request->slot_duration;
        if(is_float($total_slot)){
            session()->flash('errorMsg','Please set proper slot duration time and appointment total time.');
            return back();
        }
        $slots = [];
        for ($i = 0 ; $i < $total_slot ; $i++){
            array_push($slots,[
                'start' => $to->format('h:i A'),
                'end' => $to->addMinute($request->slot_duration)->format('h:i A'),
                'duration' => $request->slot_duration
            ]);
        }
        $slot->update([
            'date' => date('Y-m-d',strtotime($request->date)),
            'status' => $request->status,
            'created_by' => auth()->user()->id,
            'attributes' => json_encode([
                'description' => $request->description,
                'available_slots' => json_encode($slots),
                'booked_slots' => json_encode([]),
                'history' => json_encode([
                    'time' => date('Y-m-d H:i:s'),
                    'data' => json_encode($old_attribute)
                ])
            ])
        ]);
        session()->flash('successMsg','Appointment updated for date '.$request->date);
        return back();
    }
}
