<?php

namespace App\Http\Controllers;

use DB;
use App\Appointment;
use App\AppointmentLog;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request){
        $req = $request->all();
        $appointment = Appointment::paginate(10);
        return view('appointment.index',compact('appointment','req'));
    }

    public function view($id){
        $appointment = Appointment::findOrFail($id);
        return view('appointment.view',compact('appointment'));
    }

    public function updateTimeLog(Request $request, $id){
        $appointment = Appointment::findOrFail($id);
        try{
            DB::beginTransaction();
            if($request->provider_start == 1){
                $appointment->update([
                    'status' => 2
                ]);
            }
            if($request->provider_end == 1){
                $appointment->update([
                    'status' => 4
                ]);
            }
            AppointmentLog::create([
                'appointment_id' => $id,
                'user_id' => auth()->user()->id,
                'time' => date('Y-m-d H:i:s')
            ]);
            DB::commit();
            return 'success';
        }catch(\Exception $e){
            DB::rollback();
            return 'fail';
        }
    }

    public function getTimeLog(Request $request, $id){
        $html = '';
        foreach (AppointmentLog::where('appointment_id',$id)->get() as $log){
            $html .= '<tr>
                        <td>'.$log->user->name.'</td> 
                        <td>'.date('Y-m-d h:i:s A',strtotime($log->time)).'</td> 
                     </tr>';
        }
        return $html;
    }
}
