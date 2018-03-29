<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class PatientController extends Controller
{

    public function __construct() {
        $this->middleware('auth:admin');
    }

    // get edit patient page
    public function edit(Patient $patient)
    {
        return view('/admin/patient/update', compact('patient'));
    }

    // update patient status
    public function change_status(Patient $patient)
    {
        $patient->status = !$patient->status;
        $patient->save();
        $msg = ($patient->status) ? 'Patient has been activated Successfully!!' : 'Patient has been deactivated Successfully!!';
        return back()->with('status', $msg);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return back()->with('status' ,'patient has been deleted Successfully!!');  
    }

    // get add patient page
    public function add() {
        return view('admin.patient.add');
    }

    // update patient info
    public function update(Request $request, Patient $patient)
    {
         $this->validate($request,[
            'fullName'=>'required|string|min:3',
            'email' => ['required','email', Rule::unique('patients')->ignore($patient->id)],
            'mobile'=>'nullable|numeric|min:8',
            'birthday'=>'nullable|date|before:today',
            'gender' => [
                    'nullable',
                    Rule::in(['male', 'female']),
                ],
        ]);

        $patient->name = $request->fullName;
        $patient->email = $request->email;
        $patient->mobile = $request->mobile;
        $patient->date_of_birth = $request->birthday;
        $patient->gender = $request->gender;
         
        $patient->save();

        return back()->with('status' ,'Patient Info has been updated Successfully!!');
    }

    // view a table of patients
    public function index()
    {   
        $patients = Patient::all(); 
        return view('/admin/patient/view')->with('patients',$patients); 
    }

    public function store(PatientRequest $request) {
        

        $patient = new Patient ;

        $patient->name = $request->fullName;
        $patient->email = $request->email;
        $patient->mobile = $request->mobile;
        $patient->password = bcrypt($request->password);
        $patient->status = 1;
        $patient->date_of_birth = $request->date;
        $patient->gender = $request->gender;

        $patient->save();

        return redirect('/admin/patient/view')->with('status' ,'patient Added Successfully!!');

    }
}
