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
        


    public function view(Request $request)
        {
            $admins = admin::all();
            return view('admin.admin.table',compact('admins'));
        }

    public function update(Request $request)
        {
            return view('admin.admin.update');
        }

    public function delete(Request $request)
        {

        }

}
