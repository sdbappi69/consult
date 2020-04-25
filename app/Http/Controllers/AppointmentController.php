<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request){
        $req = $request->all();
        $appointment = Appointment::paginate(10);
        return view('appointment.index',compact('appointment','req'));
    }

    public function update(Request $request, $id){

    }

    public function view($id){
        $appointment = Appointment::findOrFail($id);
        return view('appointment.view',compact('appointment'));
    }
}
