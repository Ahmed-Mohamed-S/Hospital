<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\users;
use App\Models\Doctor;
use App\Models\Appointment;



class HomeController extends Controller
{
    public function redirect(){

        if(Auth::id()){
            if(Auth::user()->usertype == '0'){
             $doctors=Doctor::all();

                return view('user.home',compact('doctors'));


            }else{
                return view('admin.home');


            }




        }

        else{
            return redirect()->back();

        }
    }

    public function index(){
        if(Auth::id()){
            return redirect('home');
        }else{
        $doctors=Doctor::all();
        return view('user.home',compact('doctors'));
        }


    }
    public function Appointment(REQUEST $request){
        $newAppointment=new Appointment;
        $newAppointment->name=$request->name;
        $newAppointment->email=$request->email;
        $newAppointment->phone=$request->phone;
        $newAppointment->doctor=$request->doctor;
        $newAppointment->date=$request->date;
        $newAppointment->status=$request->status;
        $newAppointment->message=$request->message;
        if(Auth::id()){
        $newAppointment->user_id=Auth::user()->id;




        }
        $newAppointment->save();
        return redirect()->back()->with('message',' Appointment request successfully,
         we will contact with you soon');


    }
    public function my_appoint() {
        if (Auth::check()) {
            $userId = Auth::id();
            $appoints = Appointment::where('user_id', $userId)->get(); // Execute the query using get() to retrieve the appointments
            return view('user.my_appointment', compact('appoints'));
        } else {
            return redirect()->back();
        }
    }
    public function Cancel($id){
        $data=Appointment::find($id);
        $data->delete();
        return redirect()->back();

    }
    public function learnmore()
    {
        return view('user.learnmore');
    }



}
