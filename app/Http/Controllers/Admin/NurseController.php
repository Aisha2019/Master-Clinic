<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\clinic;
use App\Models\nurse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class NurseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add()
    {
    	$clinics = clinic::all();
        return view('admin.nurse.add',compact('clinics'));
    }

    public function store(Request $request)
    {
        // Validate the request...
        $this->validate($request,[
        	'fullName'=>'required|string',
        	'email'=>'required|unique:patients|email',
        	'password'=>'required|string|confirmed',
        	'mobile'=>'nullable|numeric',
        	'birthday'=>'nullable|date|before:today',
        	'gender'=>'nullable',
        	'salary'=>'required|numeric',
        	'clinic'=>'required'
        ]);
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

        if ($nurse->gender == 'male'){
            $nurse->image = '/nurse_styles/images/defualt_male.png';
        }
        else{
            $nurse->image = '/nurse_styles/images/defualt_female.png';
        }

        $nurse->save();
        return redirect('/admin/home')->with('status' ,'Added Successfully!!');
    }

    public function view(Request $request)
        {
            $nurses = nurse::all();
            foreach ($nurses as $nurse) {
                $nurse->clinic_name = DB::table('clinics')->where('id', $nurse->clinic_id)->value('name');
            }
            return view('admin.nurse.table',compact('nurses'));
        }
    public function updatepage(Request $request,$nurseid)
        {

            $nurse = nurse::find($nurseid);
            $clinics = clinic::all();
           return view('admin.nurse.update',compact('nurse'),compact('clinics'));
        }

    public function update(Request $request)
        {
             $this->validate($request,[
            'fullName'=>'required|string',
            'email'=>'required|unique:patients|email',
            'mobile'=>'nullable|numeric',
            'birthday'=>'nullable|date|before:today',
            'gender'=>'nullable',
            'salary'=>'required|numeric',
            'clinic'=>'required'
        ]);

             
             $nurse =nurse::find($request->id);
             
             $nurse->name = $request->fullName;
             $nurse->email = $request->email;
             $nurse->mobile = $request->mobile;
             $nurse->gender = $request->gender;
             $nurse->date_of_birth = $request->birthday;
             $nurse->salary= $request->salary;
             $nurse->clinic_id= $request->clinic;
             $nurse->save();

            return back()->with('status', 'updated Successfully!!');   
        }
    
 
    public function delete(Request $request,$id)
    {
            $nurse=nurse::find($id);
            $nurse->delete();        
            $nurses = nurse::all(); 
            return back()->with('nurses',$nurses)->with('status' ,'nurse  has been deleted Successfully!!');  
    }

    public function status(Request $request,$id)
    {
            $nurse=nurse::find($id);
            if($nurse->status)
            {
               $nurse->status=0;
               $nurse->save();      
            $nurses = nurse::all(); 
            return back()->with('nurses',$nurses)->with('status' ,'nurse  has been deactivated Successfully!!');  
            } 
            else{
                $nurse->status=1;
                $nurse->save();      
            $nurses = nurse::all(); 
            return back()->with('nurses',$nurses)->with('status' ,'nurse  has been activated Successfully!!'); 
            } 

    }
}
