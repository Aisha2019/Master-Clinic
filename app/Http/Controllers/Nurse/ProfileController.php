<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use App\Models\nurse;
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
        $this->middleware('auth:nurse');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nurse.profile');
    }

    public function updatePicture(Request $request) {
        $this->validate($request, [
            'picture' => 'required|image',
        ]);
        
        // store the picture (you must run this commant to view the pictures in the views `php artisan storage:link`)
        $filePath = $request->picture->store('/public/nurses/' . Auth::id());
        // update nurse data
        $admin = nurse::find(Auth::id());
        $admin->photo = $request->picture;
        $admin->save();

        return back();
    }
}
