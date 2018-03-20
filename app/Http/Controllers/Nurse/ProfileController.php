<?php

namespace App\Http\Controllers\Nurse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Image;

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
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $filename = time() . '.' . $picture->getClientOriginalExtension();
            Image::make($picture)->resize(215, 215)->save(public_path('/nurse_styles/images/' . $filename));
            $user = Auth::user();
            $user->image = '/nurse_styles/images/' . $filename;
            $user->save();
        }

        return redirect('nurse/profile');
    }
}
