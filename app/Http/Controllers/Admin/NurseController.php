<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nurse;
use App\Models\clinic;
class NurseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:nurse');
    }

    public function add()
    {
    	$clinics = Clinic::all();
        return view('admin.nurse.add',compact('clinics'));
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
        	'gender'=>'nullable',
        	'salary'=>'required|numeric',
        	'clinic'=>'required'
        ]);
        $nurse = new Nurse ;
        $nurse->name = $request->fullName;
        $nurse->email = $request->email;
        $nurse->password = bcrypt($request->password);
        $nurse->mobile = $request->mobile;
        $nurse->gender = $request->gender;
        $nurse->date_of_birth = $request->birthday;
        $nurse->salary= $request->salary;
        $nurse->clinic= $request->clinic;
        $nurse->status = 1;
        $nurse->save();
    }
}
