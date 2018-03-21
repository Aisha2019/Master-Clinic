<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function update()
    {
        return view('nurse.patient.update');
    }
   public function table()
    {
        return view('nurse.patient.table');
    }
    public function store(Request $request)
    {
        // return $request->all();
        // Validate the request...
        $this->validate($request,[
        	'fullName'=>'required|string|min:3',
        	'email'=>'required|unique:patients|email',
        	'password'=>'required|string|confirmed',
        	'mobile'=>'nullable|numeric|min:11',
        	'birthday'=>'nullable|date|before:today',
        	'zones' => [
                    'nullable',
                    Rule::in(['male', 'female']),
                ],
        ]);
        $connection='MasterClinic';
        $patient = new Patient;
        $patient->name = $request->fullName;
        $patient->email = $request->email;
        $patient->password = bcrypt($request->password);
        $patient->mobile = $request->mobile;
        $patient->gender = $request->gender;
        $patient->date_of_birth = $request->birthday;
        $patient->status = 1;
        $patient->save();

        return redirect('/nurse/home')->with('status' ,'Added Successfully!!');
    }
}
