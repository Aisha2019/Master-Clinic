<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
class PatientController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:nurse');
    }

   
  public function change_status($pid)
    {
        $patient=Patient::find($pid);
        $msg;
        if($patient->status==0)
        {
        $patient->status=1;
        $msg='patient Account has been activated Successfully!!';
        }
        else {
        $patient->status=0;
        $msg='patient Account has been deactivated Successfully!!';
        }
        $patient->save();
          return back()->with('patient',$patient)->with('status' ,$msg);
    }

      public function delete($id)
    {
   $patient=Patient::find($id);
   $patient->delete();        
   $patients = DB::table('patients')->get(); 
            return back()->with('patients',$patients)->with('status' ,'patient has been deleted Successfully!!');  

   }

    //Add New Patient

    public function add()
    {
        return view('nurse.patient.add');
    }
    public function getpatient($patientid)
    {
        $patient=Patient::find($patientid);
        return view('/nurse/patient/update')->with('patient',$patient);

    } 

    public function get()
    {
      return view('/nurse/patient/update');
    }
    public function update(Request $request)
    {
         $this->validate($request,[
            'fullName'=>'required|string|min:3',
            'email' => ['required','email', Rule::unique('patients')->ignore($request->id)],
            'mobile'=>'nullable|numeric|min:11',
            'birthday'=>'nullable|date|before:today',
            'gender' => [
                    'nullable',
                    Rule::in(['male', 'female']),
                ],
        ]);

         
         $patient =Patient::find($request->id);
         $patient->name=$request->fullName;
         $patient->email=$request->email;
         $patient->mobile=$request->mobile;
         $patient->date_of_birth=$request->birthday;
         $patient->gender=$request->gender;
         $patient->save();

        return back()->with('patient',$patient)->with('status' ,'patient Info has been updated Successfully!!');

    }
   public function patient_table()
    {   
            $patients = DB::table('patients')->get(); 
            return view('/nurse/patient/view')->with('patients',$patients); 

    }

    public function store(Request $request)
    {
        
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
