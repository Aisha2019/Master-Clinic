<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class patientcontroller extends Controller
{
    //


  public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add()
    {
        return view('admin.patient.addpatient');
    }
        public function storePatientInfo(Request $request)
    {
        // Validate the request...
        $this::Validate($request,[
        	'name'=>'required|alpha',
        	'email'=>'required|unique:patients|email',
        	'password'=>'required',
        	'confirmpassword'=>'same:password',
        	'mobile'=>'nullable|numeric|size:14',
        	'date'=>'nullable|date|before:today',
        	'gender'=>'required'
        ]);
         $patient = new Patient ;
         $patient->name=$request->name;
        $patient->email=$request->email;
         $patient->mobile=$request->mobile;
         $patient->name=$request->name;
         $patient->date_of_birth=$request->date;
         $patient->$gender =$request->gender;  
         $patient->save();
    }


}
