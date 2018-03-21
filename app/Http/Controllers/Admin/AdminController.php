<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin;
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
}
