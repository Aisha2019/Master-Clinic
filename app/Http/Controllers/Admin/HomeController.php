<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\reservation;
date_default_timezone_set('Africa/Cairo');
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $today=Date('Y-m-d');
      $id=auth()->user()->id;
      $reservations=reservation::where('admin_id',$id)->where('time','LIKE',"%{$today}%")->whereNotNull('nurse_id')->where('reject',0)->orderBy('time','desc')->get();

      $array=app('App\Http\Controllers\Nurse\ReservationsController')->getdata($reservations);
        return view('admin.home')->with('reservations',$array);
    }
}
