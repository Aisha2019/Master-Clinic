<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NurseRequest;
use App\Models\clinic;
use App\Models\nurse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class NursesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // get page to add new nurse
    public function add()
    {
    	$clinics = clinic::all();
        return view('admin.nurse.add', compact('clinics'));
    }

    // store the nurse data
    public function store(NurseRequest $request)
    {

        $nurse = new nurse;

        $nurse->name = $request->fullName;
        $nurse->email = $request->email;
        $nurse->password = bcrypt($request->password);
        $nurse->mobile = $request->mobile;
        $nurse->gender = $request->gender;
        $nurse->date_of_birth = $request->birthday;
        $nurse->salary= $request->salary;
        $nurse->clinic_id= $request->clinic;
        $nurse->status = 1;

        $nurse->save();
        return redirect('/admin/nurse/view')->with('status' ,'Nurse Added Successfully!!');
    }

    // view nurses table
    public function view(Request $request)
    {
        $nurses = nurse::all();
        foreach ($nurses as $nurse) {
            $nurse->clinic_name = DB::table('clinics')->where('id', $nurse->clinic_id)->value('name');
        }
        return view('admin.nurse.table',compact('nurses'));
    }

    public function edit(Request $request,nurse $nurse)
    {
        $clinics = clinic::all();
        return view('admin.nurse.update',compact('nurse', 'clinics'));
    }

    public function update(Request $request, nurse $nurse)
    {
        $this->validate($request,[
            'fullName' => 'required|string',
            'email' => ['required','email', Rule::unique('nurses')->ignore($nurse->id)],
            'mobile' => 'nullable|numeric|digits_between:8,20',
            'birthday' => 'nullable|date|before:today',
            'gender' => [
                    'nullable',
                    Rule::in(['male', 'female']),
                ],
            'salary' => 'required|numeric',
            'clinic' => 'required|exists:clinics,id'
        ]);
         
        $nurse->name = $request->fullName;
        $nurse->email = $request->email;
        $nurse->mobile = $request->mobile;
        $nurse->gender = $request->gender;
        $nurse->date_of_birth = $request->birthday;
        $nurse->salary = $request->salary;
        $nurse->clinic_id = $request->clinic;
        $nurse->save();

        return back()->with('status', 'updated Successfully!!');   
    }
    
 
    public function destroy(Request $request,nurse $nurse)
    {
        $nurse->delete();
        return back()->with('status' ,'nurse  has been deleted Successfully!!');  
    }

    // activate and deactivate the nurse account
    public function status(Request $request,nurse $nurse)
    {
        $nurse->status = !$nurse->status;
        $nurse->save();
        $msg = ($nurse->status) ? 'Nurse has been activated Successfully!!' : 'Nurse has been deactivated Successfully!!';
        return back()->with('status' ,$msg); 
    }
}
