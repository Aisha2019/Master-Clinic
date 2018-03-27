<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\admin;
class AdminController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add()
    {
        return view('admin.admin.addadmin');
    }

    public function store(Request $request)
    {
        // Validate the request...
            $this->validate($request,[
            'fullName'=>'required|string|min:3',
            'email'=>'required|unique:admins|email',
            'password'=>'required|string|confirmed',
            'mobile'=>'nullable|numeric|min:11',
            'role' => [
                    'nullable',
                    Rule::in(['Admin', 'Super Admin']),
                ],
        ]);
        $connection='MasterClinic';
        $admin = new Admin ;
        $admin->name=$request->fullName;
        $admin->email=$request->email;
        $admin->password = bcrypt($request->password);
        $admin->mobile=$request->mobile;
        $admin->role=$request->role;
        $admin->status = 1;
        $admin->image = '/admin_styles/images/defualt_male.png';
        $admin->save();

        return redirect('/admin/home')->with('status' ,'Admin Added Successfully!!');

    }
    public function view(Request $request)
    {
        $admins = admin::all();
        return view('admin.admin.table',compact('admins'));
    }
 

    public function updatepage(Request $request,$adminid)
        {

            $admin = admin::find($adminid);

           return view('admin.admin.update',compact('admin'));
        }

    public function update(Request $request)
        {
             $this->validate($request,[
                'fullName'=>'required|string|min:3',
                'email' => ['required','email', Rule::unique('admins')->ignore($request->id)],
                'mobile'=>'nullable|numeric|min:11',
                    
                'role' => [
                        'nullable',
                        Rule::in(['Admin', 'Super Admin']),
                    ],
            ]);

             
             $admin =admin::find($request->id);
             $admin->name=$request->fullName;
             $admin->email=$request->email;
             $admin->mobile=$request->mobile;
             
             $admin->role=$request->role;
             
             $admin->save();

            return back()->with('status', 'updated Successfully!!');   
        }
    
 
    public function delete(Request $request,$id)
    {
            $admin=admin::find($id);
            $admin->delete();        
            $admins = admin::all(); 
            return back()->with('admins',$admins)->with('status' ,'admin  has been deleted Successfully!!');  
    }

    public function status(Request $request,$id)
    {
            $admin=admin::find($id);
            if($admin->status)
            {
               $admin->status=0;
               $admin->save();      
            $admins = admin::all(); 
            return back()->with('admins',$admins)->with('status' ,'admin  has been deactivated Successfully!!');  
            } 
            else{
                $admin->status=1;
                $admin->save();      
            $admins = admin::all(); 
            return back()->with('admins',$admins)->with('status' ,'admin  has been activated Successfully!!'); 
            } 

    }

}

