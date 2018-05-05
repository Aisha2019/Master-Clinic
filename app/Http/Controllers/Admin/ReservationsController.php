<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\admin;
use App\Models\clinic;
use App\Models\nurse;
use App\Models\reservation;
use Carbon\Carbon;
  date_default_timezone_set('Africa/Cairo');
class ReservationsController extends Controller
{
    //


     public function __construct()
    {
        $this->middleware('auth:admin');
    }



        public function get()
    {
      $today=Date('Y-m-d').' 23:59:59';
      $id=auth()->user()->id;

      $reservations=reservation::where('admin_id',$id)->whereNotNull('nurse_id')->where('time','>',$today)->orderBy('time','desc')->get();
      $array=app('App\Http\Controllers\Nurse\ReservationsController')->getdata($reservations);
      return view('admin.patient.reservations')->with('reservations',$array);

    }

    public function search(Request $request)
    {
  
      $date=$request->Reservationdate;
      $id=auth()->user()->id;
      $reservations=reservation::where('admin_id',$id)->whereNotNull('nurse_id')->where('time','LIKE',"%{$date}%")->orderBy('time','desc')->get();
      $array=app('App\Http\Controllers\Nurse\ReservationsController')->getdata($reservations);
      return view('admin.patient.reservations')->with('reservations',$array);
    }

     
        
}
