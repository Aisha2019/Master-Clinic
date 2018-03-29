<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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
            'fullName' => 'required|string|min:3',
            'email' => ['required','email', Rule::unique('admins')],
            'password' => 'required|string|confirmed',
            'mobile' => 'nullable|string|min:11',
            'role' => [
                    'nullable',
                    Rule::in(['doctor', 'super']),
                ],
        ]);
        $admin = new Admin;

        $admin->name=$request->fullName;
        $admin->email=$request->email;
        $admin->password = bcrypt($request->password);
        $admin->mobile=$request->mobile;
        $admin->role=$request->role;
        $admin->status = 1;

        $admin->save();

        return redirect('/admin/home')->with('status' ,'Admin Added Successfully!!');
    }

    public function view(Request $request)
    {
        $admins = admin::all()->except(Auth::id());
        return view('admin.admin.table',compact('admins'));
    }
 

    public function edit(Request $request, admin $admin)
    {
        return view('admin.admin.update',compact('admin'));
    }

    public function update(Request $request, admin $admin)
    {
        $this->validate($request,[
            'fullName'=>'required|string|min:3',
            'email' => ['required','email', Rule::unique('admins')->ignore($admin->id)],
            'mobile'=>'nullable|string|min:11',        
            'role' => [
                    'nullable',
                    Rule::in(['super', 'doctor']),
                ],
        ]);

         
        $admin->name=$request->fullName;
        $admin->email=$request->email;
        $admin->mobile=$request->mobile;
        $admin->role=$request->role;
        
        $admin->save();

        return back()->with('status', 'updated Successfully!!');   
    }
    
 
    public function destroy(Request $request,admin $admin)
    {
        $admin->delete();
        return back()->with('status' ,'Admin has been deleted Successfully!!');  
    }

    // activate and deactivate the admin account
    public function status(Request $request,admin $admin)
    {
        $admin->status = !$admin->status;
        $admin->save();
        $msg = ($admin->status) ? 'Admin has been activated Successfully!!' : 'Admin has been deactivated Successfully!!';
        return back()->with('status' ,$msg); 
    }

}

