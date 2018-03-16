<?php

namespace App\Http\Controllers\nurse;

use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate the request...
        $request->Validate([
        	'fullName'=>'required|alpha',
        	'email'=>'required|unique|email',
        	'password'=>'required',
        	'mobile'=>'nullable|numeric|size:14',
        	'birthday'=>'nullable|date|before:today',
        	'gender'=>'nullable|in(['male','female'])'
        ]);
        $connection='MasterClinic';
        $patient = new Patient ;

        $patient->save();
    }
}
