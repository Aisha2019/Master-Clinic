<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\clinic;
use App\Models\material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class MaterialsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // get page to add new material
    public function add()
    {
    	$clinics = clinic::all();
    	$categories = category::all();
        return view('admin.material.add', compact('clinics','categories'));
    }

    // store the material data
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name' => 'required|string',
            'clinic' => 'required|exists:clinics,id',
            'category' => 'required|exists:categories,id',
            'cost' => 'required|numeric',
            'min_num' => 'required|numeric',
            'num' => 'required|numeric'
        ]);

        $material = new material;

        $material->name = $request->name;
        $material->clinic_id = $request->clinic;
        $material->category_id = $request->category;
        $material->cost= $request->cost;
        $material->num= $request->num;
        $material->min_num= $request->min_num;
        
        $material->save();
        return redirect('/admin/material/view')->with('status' ,'Material Added Successfully!!');
    }

    // view materials table
    public function view(Request $request)
    {
        $materials = material::all();
        foreach ($materials as $material) {
            $material->clinic_name = DB::table('clinics')->where('id', $material->clinic_id)->value('name');
            $material->category_name = DB::table('categories')->where('id', $material->category_id)->value('name');
        }
        return view('admin.material.table',compact('materials'));
    }

    public function edit(Request $request,material $material)
    {
        $clinics = clinic::all();
    	$categories = category::all();
        return view('admin.material.update',compact('material', 'clinics','categories'));
    }

    public function update(Request $request, material $material)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'clinic' => 'required|exists:clinics,id',
            'category' => 'required|exists:categories,id',
            'cost' => 'required|numeric',
            'min_num' => 'required|numeric',
            'num' => 'required|numeric'
        ]);
         
        $material->name = $request->name;
        $material->clinic_id = $request->clinic;
        $material->category_id = $request->category;
        $material->cost= $request->cost;
        $material->num= $request->num;
        $material->min_num= $request->min_num;
        

        $material->save();

        return back()->with('status', 'updated Successfully!!');   
    }
    
 
    public function destroy(Request $request,material $material)
    {
        $material->delete();
        return back()->with('status' ,'Material  has been deleted Successfully!!');  
    }

}
