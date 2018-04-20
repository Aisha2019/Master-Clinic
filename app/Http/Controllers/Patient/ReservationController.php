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
      $reservation=self::getdata($reservation);
      $admins=Admin::where('status',1)->get();
        return view('user.reservations.update')->with('clinics',$clinics)->with('admins',$admins)->with('reservation',$reservation);
      }
    


   public function store(Request $request){

$this->validate($request,[
           
            'Reservationdate'=>'required|after:yesterday',
            'Reservationtime'=>'required',
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
;
         $reservation->time=$date;
         $reservation->save();
        return back()->with('status' ,'reservation Added Successfully!!');
          
   }

  public function getdata($reservations)
   {
    $array= array();
      foreach ($reservations as $reservation) {
        $date=date("d-M-Y", strtotime($reservation->time));
        $time=date("h:i a", strtotime($reservation->time));
        
      $doctor=Admin::where('id',$reservation->admin_id)->value('name');
      $patient=auth()->user()->name;
      $clinic=clinic::where('id',$reservation->clinic_id)->value('name');
      $nurse=Nurse::where('id',$reservation->nurse_id)->value('name');
       array_push($array, 
        array(
            'id'=>$reservation->id,
            'doctor'=>$doctor,
            'clinic'=>$clinic,
            'nurse'=>$nurse,
            'patient'=>$patient,
            'date'=>$date,
            'time'=>$time,
             )
        );
    }  
  return $array;
   }

}
