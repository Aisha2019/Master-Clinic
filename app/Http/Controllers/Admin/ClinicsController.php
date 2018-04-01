<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;
use App\Models\clinic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class ClinicsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // get add clinic page
    public function add() {
        return view('admin.clinic.add');
    }

    public function store(ClinicRequest $request) {
        
        $clinic = new clinic ;

        $clinic->name = $request->name;
        $clinic->email = $request->email;
        $clinic->telephone = $request->phone;
        $clinic->address = $request->address;
        $clinic->start_time = Carbon::parse($request->start_time)->format('H:i:s');
        $clinic->end_time = Carbon::parse($request->end_time)->format('H:i:s');

        $clinic->save();

        return redirect('admin/clinic/view')->with('status' ,'clinic Added Successfully!!');

    }

    public function destroy(clinic $clinic)
    {
        $clinic->delete();
        return back()->with('status' ,'clinic has been deleted Successfully!!');  
    }

    // view a table of clinics
    public function view()
    {   
        $clinics = clinic::all(); 
        return view('admin.clinic.table')->with('clinics',$clinics); 
    }

    // get edit clinic page
    public function edit(clinic $clinic)
    {
        return view('/admin/clinic/update', compact('clinic'));
    }

    public function update(Request $request,clinic $clinic) {
    	$this->validate($request,[
            'email' => ['required','email', Rule::unique('clinics')->ignore($clinic->id)],
            'name' => 'required|string|min:3',
            'phone' => 'nullable|numeric|digits_between:8,20',
                   ]);

        $clinic->name = $request->name;
        $clinic->email = $request->email;
        $clinic->telephone = $request->phone;
        $clinic->address = $request->address;
        $clinic->start_time = $request->start_time;
        $clinic->end_time = $request->end_time;

        $clinic->save();

        return back()->with('status' ,'clinic Info has been updated Successfully!!');

    }
}
