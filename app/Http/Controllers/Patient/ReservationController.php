<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\Admin;
use App\Models\Nurse;
use App\Models\Reservation;
use DB;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class ReservationController extends Controller
{
    //
public function __construct()
    {
        $this->middleware('auth');
    }
    public function get()
    {
    	$clinics= Clinic::all();
      $admins=Admin::where('status',1)->get();
        return view('user.reservations.create')->with('clinics',$clinics)->with('admins',$admins);
    }
    public function history()
    {
        $user = auth()->user();
        $reservations= Reservation::where('patient_id',$user->id)
               ->orderBy('time', 'desc')
               ->get();
       $array=self::getdata($reservations);  
        return view('user.reservations.history')->with('reservations',$array);
    }
  

    public function edit(Reservation $reservation)
    {
      $clinics=Clinic::all();
      $reservation=Reservation::where('id',$reservation->id)->get();
      $reservation=self::getdata($reservation);
      $admins=Admin::where('status',1)->get();
        return view('user.reservations.update')->with('reservations',$reservation)->with('clinics',$clinics)->with('admins',$admins);
      }
    
   public function destroy(Reservation $reservation)
   {
         $reservation=Reservation::find($reservation->id); 
       $reservation->delete();
        return self::history()->with('status' ,'
          Reservation deleted'); 
   }


public function update(Request $request, Reservation $reservation)
{


$this->validate($request,[
           
            'date'=>'required|after:now',
            'time'=>'required|min:"8:00 AM"|max:"10:00 PM"',
        ]);
         $reservation=Reservation::find($reservation->id);
         $reservationdate= $request->date.' '.$request->time;
         $reservationdate=Carbon::createFromFormat('d-m-Y H:i A',$reservationdate)->toDateTimeString();
         if($request->admin!="Change Doctor")
         {
         $reservation->admin_id = $request->admin;
         }
         if($request->clinic!="Change Clinic")
         {
         $reservation->clinic_id = $request->clinic;
         }
         $reservation->nurse_id=null;
         $reservation->time=$reservationdate;
         $reservation->save();
         return self::history()->with('status' ,'reservation Added Successfully!!');

}
   public function store(Request $request){

$this->validate($request,[
           
            'date'=>'required|after:now',
            'time'=>'required|min:"8:00 AM"|max:"10:00 PM"',
            'clinic'=>'required',
            'doctor'=>'required',
        ]);

         $now=Carbon::now()->toDateTimeString();
         $date= $request->Reservationdate.' '.$request->Reservationtime;
         $date=Carbon::createFromFormat('Y-m-d H:i A',$date)->toDateTimeString();

         // return $request->all();
         $reservation= new Reservation;
         $user = auth()->user();
         $reservation->admin_id = $request->admin;
         $reservation->clinic_id = $request->clinic;
         $reservation->patient_id = $user->id;
         $reservation->attend=0;
         $reservation->nurse_id=null;
         $reservation->time=$date;
         $reservation->save();
        return back()->with('status' ,'reservation Added Successfully!!');
          
   }

  public function getdata($reservations)
   {
    $array= array();
      foreach ($reservations as $reservation) {
        $date=date("d-m-Y", strtotime($reservation->time));
        $time=date("H:i A", strtotime($reservation->time));
        
      $doctor=Admin::where('id',$reservation->admin_id)->value('name');
      $patient=auth()->user()->name;
      $clinic=clinic::where('id',$reservation->clinic_id)->value('name');
      $nurse=Nurse::where('id',$reservation->nurse_id)->value('name');
      $response=$reservation->reject;
      $attendance=$reservation->attend;
       array_push($array, 
        array(
            'id'=>$reservation->id,
            'doctor'=>$doctor,
            'clinic'=>$clinic,
            'nurse'=>$nurse,
            'patient'=>$patient,
            'date'=>$date,
            'time'=>$time,
            'response'=>$response,
            'attend'=>$attendance,
             )
        );
    }  
  return $array;
   }

}
