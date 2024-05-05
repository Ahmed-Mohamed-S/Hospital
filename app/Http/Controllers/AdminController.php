<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Doctor;
use App\Models\Appointment;
use Notification;
use App\Notifications\SendNotification;
use Illuminate\Support\Facades\Auth;




class AdminController extends Controller
{
    public function AddView(){
        if(Auth::id()){
            if(Auth::user()->usertype==1){ //means admin
                return view('admin.add_doctor');

            }else{
                return redirect()->back();
            }
        }else{
            return redirect('login');
        }

    }

    public function AddDoctor(REQUEST $request){
        $newDoctor = new Doctor();
        $newDoctor -> name=$request-> name;
        $newDoctor->phone = $request->phone;
        $newDoctor -> speciality =$request-> speciality;
        $newDoctor -> room =$request-> room;
        $path='';
        if ($request->hasFile('image')) {
            $path = $request->file('image')->move('uploads', Str::uuid()->toString() . '.' . $request->file('image')->getClientOriginalExtension());
        }


        $newDoctor -> image =$path;


        $newDoctor -> save();



            return redirect()->back()->with('message','The doctor added successfully');

    }
    public function ShowAppointment(){
        if(Auth::id()){
            if(Auth::user()->usertype==1){   //means admin
                $data=Appointment::all();

                return view('admin.show_appoint',compact('data'));

            }else{
                return redirect()->back();
            }


        }else{
            return redirect('login');
        }


    }
    public function approvedAppointment($id){
        $data=Appointment::find($id);

        $data->status='approved';
        $data->save();
        return redirect()->back();

    }
    public function cancelledAppointment($id){
        $data=Appointment::find($id);

        $data->status='cancelld';
        $data->save();
        return redirect()->back();


    }
    public function ShowDoctors(){
        $doctors=Doctor::all();

        return view('admin.showDoctors',compact('doctors'));


    }
    public function DeleteDoctor($id){
        $docs=Doctor::find($id);
        $docs->delete();

        return redirect()->back();;


    }
    public function UpdateDoctor($id){
        $docs=Doctor::find($id);
        return view('admin.updateDoctor',compact('docs'));



    }
    public function EditDoctor(REQUEST $request , $id){
        $doctor=Doctor::find($id);
        $doctor->name=$request->name;
        $doctor->phone=$request->phone;
        $doctor->speciality=$request->speciality;
        $doctor->room=$request->room;
        // $image=$request->image;

        $path='';
        if ($request->hasFile('image')) {
            $imagename = Str::uuid()->toString() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->move('uploads', $imagename);
            $doctor->image = $path;
        }


        $doctor->save();



        return redirect()->back()->with('message','the doctor updated successfully');



    }
    public function ViewMail($id){
        $mails=Appointment::find($id);
        return view('admin.ViewMail',compact('mails'));

    }
    public function SendEmail( Request $request , $id){
        $data=Appointment::find($id);
        $details=[
            'greeting'=>$request->greeting,
            'body'=>$request->body,
            'actiontext'=>$request->actiontext,
            'actionurl'=>$request->actionurl,
            'endpart'=>$request->endpart,
        ];
        Notification::send($data,new SendNotification($details));

        return resirect()->back()->with('message','Email sent successfully');

    }



}
