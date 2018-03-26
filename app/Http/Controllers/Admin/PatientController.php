<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Patient;
class PatientController extends Controller
{

    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function add() {
        return view('admin.patient.addpatient');
    }

    public function update()
    {
        return view('admin.patient.update');
    }

    // view a table of patients
    public function view()
    {
        $patients = Patient::all();
        return view('admin.patient.table' ,compact('patients'));
    }

    public function store(Request $request) {
        // Validate the request...
        $this->validate($request,[
            'fullName'=>'required|string|min:3',
            'email'=>'required|unique:patients|email',
            'password'=>'required|string|confirmed',
            'mobile'=>'nullable|numeric|min:11',
            'birthday'=>'nullable|date|before:today',
            'gender' => [
                    'nullable',
                    Rule::in(['male', 'female']),
                ],
        ]);

        $patient = new Patient ;
        $patient->name=$request->fullName;
        $patient->email=$request->email;
        $patient->mobile=$request->mobile;
        $patient->password = bcrypt($request->password);
        $patient->status = 1;
        $patient->date_of_birth=$request->date;
        $patient->gender =$request->gender;  
        $patient->save();
        return redirect('/admin/home')->with('status' ,'patient Added Successfully!!');

    }



}
