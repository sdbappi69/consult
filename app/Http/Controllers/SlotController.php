<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlotRequest;
use App\Slot;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function index(Request $request){
        $req = $request->all();
        $appointment = Slot::where('provider_id',auth()->user()->id);
        ($request->f_date ? $appointment->where('date',$request->f_date) : null);
        $appointment = $appointment->paginate(10);
        return view('slot.index',compact('appointment','req'));
    }

    public function store(SlotRequest $request){
        $validator = Validator::make($request->all(), [
            'date' => ['required','after:today','before:'.Carbon::now()->addDay(7)->format('Y-m-d'),
                    Rule::unique('slots','date')->where(function($query){
                        $query->where('provider_id',auth()->user()->id);
                    })
                ],
            'status' => 'required|between:1,2',
            'slot_duration' => 'required|numeric',
            'time_from' => 'required',
            'time_to' => 'required|after:time_from',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
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
        Slot::create([
           'provider_id' => auth()->user()->id,
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
