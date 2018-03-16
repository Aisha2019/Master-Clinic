<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:nurse');
    }

    public function add()
    {
        return view('nurse.patient.add');
    }

    public function store(Request $request)
    {
        // Validate the request...
        $this::validate($request,[
        	'fullName'=>'required|string',
        	'email'=>'required|unique:patients|email',
        	'password'=>'required|string|confirmed',
        	'mobile'=>'nullable|numeric',
        	'birthday'=>'nullable|date|before:today',
        	'gender'=>'nullable'
        ]);
        $patient = new Patient ;
        $patient->name = $request->fullName;
        $patient->email = $request->email;
        $patient->password = vcript($request->password);
        $patient->mobile = $request->mobile;
        $patient->gender = $request->gender;
        $patient->date_of_birth = $request->birthday;
        $patient->status = 1;
        $patient->save();
    }
}
