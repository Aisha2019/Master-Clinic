<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $request->Validate([
        	'name'=>'required|alpha',
        	'email'=>'required|unique|email',
        	'password'=>'required|confirmed',
        	'confirmpassword'=>'same:password',
        	'mobile'=>'nullable|numeric|size:14',
        	'date'=>'nullable|date|before:today',
        	'role'=>'required|nullable|in([Admin,superAdmin])'
        ]);
        $connection='MasterClinic';
        $admin = new Admin ;
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->mobile=$request->mobile;
        $admin->role=$request->role;
        $admin->save();
    }
}
