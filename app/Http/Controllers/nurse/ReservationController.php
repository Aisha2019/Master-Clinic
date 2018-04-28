<?php

namespace App\Http\Controllers\nurse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\Admin;
use App\Models\Nurse;
use DB;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class ReservationController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:nurse');
    }
 
    public function change_attendance(Reservation $reservation)
    {
        $reservation=Reservation::find($reservation->id);   
        $reservation->attend=1;
        $reservation->save();
       
        return self::get()->with('status','User attendance has been confirmed');
    }
    public function get()
    {
      $today=Carbon::now();
      $today=Carbon::parse($today)->format('Y-m-d');
      $reservations=Reservation::where('time','LIKE',"%{$today}%")->orderBy('time','desc')->get();
      $array=self::getdata($reservations);      

      return view('nurse.patient.reservations')->with('reservations',$array);

    }

    public function confirm($reservation_id)
    {
     $reservation=Reservation::find($reservation_id); 
     $reservation->nurse_id=auth()->user()->id;
     $reservation->save();
     return back()->with('status' ,'Reservation confirmed');
    }   

    public function destroy(Reservation $reservation)
    {
        $reservation=Reservation::find($reservation_id); 
        $reservation->reject=1;
        $reservation->nurse_id=auth()->user()->id;
        $reservation->save();
        return back()->with('status' ,'
        	Reservation rejected ');  
    }
    public function search(Request $request)
    {
  
      $date=$request->Reservationdate;
      $reservations=Reservation::where('time','LIKE',"%{$date}%")->orderBy('time','desc')->get();
      $array=self::getdata($reservations);      
      return view('nurse.patient.reservations')->with('reservations',$array);
    }


   
       public function getdata($reservations)
   {
   	$array= array();
      foreach ($reservations as $reservation) {
      	$date=date("d-M-Y", strtotime($reservation->time));
        $time=date("h:i a", strtotime($reservation->time));
		
      $doctor=Admin::where('id',$reservation->admin_id)->value('name');
      $patient=Patient::where('id',$reservation->patient_id)->value('name');
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

