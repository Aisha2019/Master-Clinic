<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class admincontroller extends Controller
{
    //


     public function storeAdminInfo(Request $request)
    {
        // Validate the request...
        $request->Validate([
        	'name'=>'required|alpha',
        	'email'=>'required|unique|email',
        	'password'=>'required|confirmed',
        	'confirmpassword'=>'same:password',
        	'mobile'=>'nullable|numeric|size:14',
        	'date'=>'nullable|date|before:today',
        	'role'=>'required|nullable|in(['Admin','superAdmin'])'
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
