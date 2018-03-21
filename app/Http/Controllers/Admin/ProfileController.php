<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profile');
    }

    public function updatePicture(Request $request) {
        $this->validate($request, [
            'picture' => 'required|image',
        ]);
        
        // store the picture (you must run this commant to view the pictures in the views `php artisan storage:link`)
        $filePath = $request->picture->store('/public/admins/' . Auth::id());
        // update admin data
        $admin = admin::find(Auth::id());
        $admin->photo = $request->picture;
        $admin->save();

        return back();
    }
}
