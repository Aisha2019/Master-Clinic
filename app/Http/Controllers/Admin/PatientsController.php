<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use App\Models\image;
use App\Models\comment;
use App\Models\admin;
use App\Models\prescription;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use Storage;

class PatientsController extends Controller
{

    public function __construct() {
        $this->middleware('auth:admin');
    }

    // get edit patient page
    public function edit(Patient $patient)
    {
        return view('/admin/patient/update', compact('patient'));
    }

    // update patient status
    public function change_status(Patient $patient)
    {
        $patient->status = !$patient->status;
        $patient->save();
        $msg = ($patient->status) ? 'Patient has been activated Successfully!!' : 'Patient has been deactivated Successfully!!';
        return back()->with('status', $msg);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return back()->with('status' ,'patient has been deleted Successfully!!');  
    }

    // get add patient page
    public function add() {
        return view('admin.patient.add');
    }

    // update patient info
    public function update(Request $request, Patient $patient)
    {
         $this->validate($request,[
            'fullName'=>'required|string|min:3',
            'email' => ['required','email', Rule::unique('patients')->ignore($patient->id)],
            'mobile'=>'nullable|numeric|digits_between:8,20',
            'birthday'=>'nullable|date|before:today',
            'gender' => [
                    'nullable',
                    Rule::in(['male', 'female']),
                ],
        ]);

        $patient->name = $request->fullName;
        $patient->email = $request->email;
        $patient->mobile = $request->mobile;
        $patient->date_of_birth = $request->birthday;
        $patient->gender = $request->gender;
         
        $patient->save();

        return back()->with('status' ,'Patient Info has been updated Successfully!!');
    }

    // view a table of patients
    public function index()
    {   
        $patients = Patient::all(); 
        return view('/admin/patient/view')->with('patients',$patients); 
    }

    public function store(PatientRequest $request) {
        

        $patient = new Patient ;

        $patient->name = $request->fullName;
        $patient->email = $request->email;
        $patient->mobile = $request->mobile;
        $patient->password = bcrypt($request->password);
        $patient->status = 1;
        $patient->date_of_birth = $request->date;
        $patient->gender = $request->gender;

        $patient->save();

        return redirect('/admin/patient/view')->with('status' ,'patient Added Successfully!!');

    }

    /**
     * Display the specified resource.
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function view_file(Patient $patient){
        return view('/admin/patient/file', compact('patient'));
    }

     /**
     * Display the specified resource.
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function print_file(Patient $patient){
        return view('/admin/patient/print', compact('patient'));
    }

     /**
     * Display the specified resource.
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit_file(Patient $patient){
        return view('/admin/patient/updatefile', compact('patient'));
    }

     /**
     * Convert a string of HTML tags to array of separate tags
     *
     * @param  String $tags
     * @return array
     */
    private function string2tags($tags){
        $tagsArray = array();
        $start = 0;
        $flag = false;

        for ($i = 0; $i < strlen($tags); $i++){
            if($flag == false && $tags[$i] == '<'){
                $flag = true;
                $start = $i;
            }

            if($flag == true && $tags[$i] == '<'){
                if($tags[$i + 1] == '/'){
                    $i = $i + 2;
                    while($tags[$i++] != '>');
                    $tagsArray[] = substr($tags, $start, $i - $start);
                    $flag = false;
                    $i--;
                }
            }

            if($i == strlen($tags)){
                break;
            }
        }

        return $tagsArray;
    }

    /**
     * Get image size from stored image
     *
     * @param  String $imagePath
     * @return Array
     */
    private function data2size($imagePath){
        $photo = Storage::get($imagePath);

        $size = getimagesizefromstring($photo);

        $dimentions = array();

        $dimentions[] = $size[0];
        $dimentions[] = $size[1];

        return $dimentions;
    }

     /**
     * Group all images created at the same time in an array
     *
     * @param  Array $images
     * @return array
     */
    public function groupImages($images)
    {
        for ($i = 0; $i < count($images); $i++) {
            $imageSize = $this->data2size($images[$i]->image);

            $images[$i]->width = $imageSize[0];
            $images[$i]->height = $imageSize[1];
        }

        if (count($images) > 1){
            $start = $images[0]->created_at;
            $group[] = $images[0];
            for ($i = 1; $i < count($images); $i++) {
                if ($images[$i]->created_at == $start) {
                    $group[] = $images[$i];
                    if($i == count($images) - 1){
                        $photos[] = $group;
                    }
                }
                else{
                    $photos[] = $group;
                    $group = null;
                    $group[] = $images[$i];
                    $start = $images[$i]->created_at;
                }
            }
        }
        else if(count($images) == 1) {
            $group[] = $images[0];
            $photos[] = $group;
        }
        else{
            $photos = null;
        }

        return $photos;
    }

    /**
     * Group all file elements to one array
     *
     * @param  Array $prescriptions
     * @param  Array $images
     * @param  Array $comments
     * @return array
     */
    public function arrays2pages($prescriptions, $images, $comments)
    {
        $pages = null;
        $sortedPages = null;

        for ($i = 0; $i < count($prescriptions); $i++) {
            $admin = Admin::find($prescriptions[$i]->admin_id);
            $page = array($prescriptions[$i], null, null, $admin->name, $admin->email, $prescriptions[$i]->created_at);
            $sortedPages[] = $prescriptions[$i]->created_at;

            for ($j = 0; $j < count($images); $j++) {
                $image = $images[$j];
                if($image != null) {
                    if ($image[0]->created_at == $prescriptions[$i]->created_at) {
                        $page[1] = $image;
                        $images[$j] = null;
                        break;
                    }
                }
            }

            for ($j = 0; $j < count($comments); $j++) {
                if($comments[$j] != null) {
                    if ($comments[$j]->created_at == $prescriptions[$i]->created_at) {
                        $page[2] = $comments[$j];
                        $comments[$j] = null;
                        break;
                    }
                }
            }

            $pages[] = $page;
        }

        for ($i = 0; $i < count($images); $i++) {
            if ($images[$i] != null) {
                $image = $images[$i];
                $admin = Admin::find($image[0]->admin_id);
                $page = array(null, $image, null, $admin->name, $admin->email, $image[0]->created_at);
                
                $sortedPages[] = $image[0]->created_at;

                for ($j = 0; $j < count($images); $j++) {
                    if ($comments[$j] != null) {
                        if ($comments[$j]->created_at == $image[0]->created_at) {
                            $page[2] = $comments[$j];
                            $comments[$j] = null;
                            break;
                        }
                    }
                }

                $pages[] = $page;
            }
        }

        foreach ($comments as $comment) {
            if ($comment != null) {
                $admin = Admin::find($comment->admin_id);
                $sortedPages[] = $comment->created_at;
                $pages[] = array(null, null, $comment, $admin->name, $admin->email, $comment->created_at);
            }
        }

        return array($pages, $sortedPages);
    }

    /**
     * Sort pages with creation time
     *
     * @param  Array $sort
     * @param  Array $pages
     * @return array
     */
    public function sortPages($sort, $pages){
        $sortedPages = null;

        sort($sort, SORT_REGULAR);

        foreach ($sort as $s) {
            foreach($pages as $page){
                if ($page[0] != null){
                    if ($s == $page[0]->created_at){
                        $sortedPages[] = $page;
                        break;
                    }
                }
                else if ($page[1] != null) {
                    $p = $page[1];
                    if ($s == $p[0]->created_at){
                        $sortedPages[] = $page;
                        break;
                    }
                }
                else{
                    if ($s == $page[2]->created_at){
                        $sortedPages[] = $page;
                        break;
                    }
                }
            }
        }

        return $sortedPages;
    }

    /**
     * Create pages array from prescriptions, images and comments
     *
     * @param  Patient $patient
     * @return array
     */
    public function get_pages($patient){
        $prescriptions = $patient->prescriptions;
        $images = $this->groupImages($patient->images);
        $comments = $patient->comments;
        
        $pages = $this->arrays2pages($prescriptions, $images, $comments);
        
        $pages = $this->sortPages($pages[1], $pages[0]);

        return $pages;
    }

    /**
     * Retrieve patient file from database and create html view of it
     *
     * @param  Patient  $patient
     * @return array
     */
    public function create_file($patient){
        $pages = $this->get_pages($patient);
        $file = null;
        $num_pages = 0;
        $num_figues = 0;

        foreach ($pages as $page) {
            $prescriptions = $page[0];
            $images = $page[1];
            $comments = $page[2];
            $date = $page[5];
            $doctor_name = $page[3];
            $doctor_email = $page[4];

            $page = "<div class='page'><div class='subpage'><header class=head'></header><div class='content'>";
            if ($num_pages == 0) {
                $page .= '<h1 style="font-family: ' . "'Economica', sans-serif; font-weight: bold; font-size: 30pt; margin: 0px; padding: 0px" . '">' . $patient->name . "</h1>";
            }
            else{
                $page .= "<br><br>";
            }
            $page .= '<h2 style="font-family:' . " 'Economica', sans-serif; font-size: 14pt; color: #666666;" . '">Doctor: DR. ' . strtoupper($doctor_name) . "</h2>";
			$page .= '<h2 style="font-family:' . " 'Economica', sans-serif; font-size: 14pt; color: #199ebc" . '">' . $doctor_email . "</h2>";
            $page .= "<img src=" . '"{{ asset(' . "'/user_styles/images/bar1.png'" . ') }}"' . ">";
            $page .= '<h1 style="font-family: ' . "'Open Sans', sans-serif; font-weight: bold; font-size: 16pt;" . '">' . $date . "</h1>";

            $num_pages++;
            $num_lines = 25;

            if ($prescriptions != null) {
                $page .= '<h2 style="font-family: ' . "'Open Sans', sans-serif; font-weight: bold;" . '">' . "Prescriptions</h2>";
                $prescriptions = $this->string2tags($prescriptions->name);

                foreach($prescriptions as $prescription){
                    if (strpos($prescription, '<h1>') !== false || strpos($prescription, '<h2>') !== false || strpos($prescription, '<h3>') !== false) {
                        if($num_lines >= 2) {
                            $page .= $prescription;
                            $num_lines = $num_lines - 2;
                        }
                        else{
                            $file[] = $page;
                            $page = "<div class='page'><div class='subpage'><header class=head'></header><div class='content'>";
                            $page .= "<img src=" . '"{{ asset(' . "'/user_styles/images/bar1.png'" . ') }}"' . "><br><br>";
                            $page .= $prescription;
                            $num_lines = 29;
                            $num_pages++;

                        }
                    }
                    else{
                        if($num_lines >= 1) {
                            $page .= $prescription;
                            $num_lines--;
                        }
                        else{
                            $file[] = $page;
                            $page = "<div class='page'><div class='subpage'><header class=head'></header><div class='content'>";
                            $page .= "<img src=" . '"{{ asset(' . "'/user_styles/images/bar1.png'" . ') }}"' . "><br><br>";
                            $page .= $prescription;
                            $num_lines = 30;
                            $num_pages++;
                        }
                    }
                }
            }

            if ($images != null) {
                $page .= '<h2 style="font-family: ' . "'Open Sans', sans-serif; font-weight: bold;" . '">' . "Images</h2>";

                foreach($images as $image){
                    if (($image->height + 25) >= 907) {
                        $file[] = $page;
                        $page = "<div class='page'><div class='subpage'><header class=head'></header><div class='content'>";
                        $page .= "<img src=" . '"{{ asset(' . "'/user_styles/images/bar1.png'" . ') }}"' . "><br><br>";
                        $page .= "<img src='{{ Storage::disk('local')->url('" . $image->image . "') }}' class='img-responsive' style='height: 877px; max-width: 100%;' >";
                        $page .= "<p><strong>Figue " . ++$num_figues . ": " . $image->caption . "</strong></p>";
                        $file[] = $page;
                        $page = "<div class='page'><div class='subpage'><header class=head'></header><div class='content'>";
                        $page .= "<img src=" . '"{{ asset(' . "'/user_styles/images/bar1.png'" . ') }}"' . "><br><br>";
                        $num_lines = 31;
                        $num_pages = $num_pages + 2;
                    }
                    else if (($image->height + 25) >= 24 * $num_lines) {
                        $file[] = $page;
                        $page = "<div class='page'><div class='subpage'><header class=head'></header><div class='content'>";
                        $page .= "<img src=" . '"{{ asset(' . "'/user_styles/images/bar1.png'" . ') }}"' . "><br><br>";
                        $page .= "<img src='{{ Storage::disk('local')->url('" . $image->image . "') }}' class='img-responsive' style='max-width: 100%;' >";
                        $page .= "<p><strong>Figue " . ++$num_figues . ": " . $image->caption . "</strong></p>";

                        $num_lines = 31 - ceil(($image->height + 25) / 24.0);
                        $num_pages++;
                    }
                    else{
                        $page .= "<img src='{{ Storage::disk('local')->url('" . $image->image . "') }}' class='img-responsive' style='max-width: 100%;' >";
                        $page .= "<p><strong>Figue " . ++$num_figues . ": " . $image->caption . "</strong></p>";

                        $num_lines = $num_lines - ceil(($image->height + 25) / 24.0);
                    }
                }
            }
            
            if ($comments != null) {
                $page .= '<h2 style="font-family: ' . "'Open Sans', sans-serif; font-weight: bold;" . '">' . "Comments</h2>";
                $comments = $this->string2tags($comments->name);

                foreach($comments as $comment){
                    if (strpos($comment, '<h1>') !== false || strpos($comment, '<h2>') !== false || strpos($comment, '<h3>') !== false) {
                        if($num_lines >= 2) {
                            $page .= $comment;
                            $num_lines = $num_lines - 2;
                        }
                        else{
                            $file[] = $page;
                            $page = "<div class='page'><div class='subpage'><header class=head'></header><div class='content'>";
                            $page .= "<img src=" . '"{{ asset(' . "'/user_styles/images/bar1.png'" . ') }}"' . "><br><br>";
                            $page .= $comment;
                            $num_lines = 29;
                            $num_pages++;

                        }
                    }
                    else{
                        if($num_lines >= 1) {
                            $page .= $comment;
                            $num_lines--;
                        }
                        else{
                            $file[] = $page;
                            $page = "<div class='page'><div class='subpage'><header class=head'></header><div class='content'>";
                            $page .= "<img src=" . '"{{ asset(' . "'/user_styles/images/bar1.png'" . ') }}"' . "><br><br>";
                            $page .= $comment;
                            $num_lines = 30;
                            $num_pages++;
                        }
                    }
                }
            }
        }

        return $file;
    }

    /**
     * Store file photos
     *
     * @param  Image $photo
     * @param  String $caption
     * @param  Int $id
     * @return void
     */
    private function store_file_photo($photo, $caption, $id){
        // store the picture (you must run this commant to view the pictures in the views `php artisan storage:link`)
        $filePath = $photo->store('/public/patients/files/' . $id);

        $photo = new image;

        $photo->image = $filePath;
        $photo->caption = $caption;
        $photo->patient_id = $id;
        $photo->admin_id = Auth::user()->id;

        $photo->save();
    }

    /**
     * Store file photos
     *
     * @param  Array $photos
     * @param  Array $captions
     * @param  Int $id
     * @return void
     */
    private function store_file_photos($photos, $captions, $id){
        for ($i = 0; $i < count($photos); $i++) {
            $this->store_file_photo($photos[$i], $captions[$i], $id);
        }
    }

     /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function update_file(Request $request, Patient $patient){
        $prescriptions = null;
        $comments = null;
        $photos = null;
        $captions = null;
        $pages = null;

        $this->validate($request, [
            'photo_1' => 'image',
            'photo_2' => 'image',
            'photo_3' => 'image',
            'photo_4' => 'image',
            'photo_5' => 'image',
            'photo_6' => 'image',
            'photo_7' => 'image',
            'photo_8' => 'image',
            'photo_9' => 'image',
            'photo_10' => 'image',
        ]);

        $captions = array(
            $request->photo_1_cap,
            $request->photo_2_cap,
            $request->photo_3_cap,
            $request->photo_4_cap,
            $request->photo_5_cap,
            $request->photo_6_cap,
            $request->photo_7_cap,
            $request->photo_8_cap,
            $request->photo_9_cap,
            $request->photo_10_cap,
        );

        if ($photos != null) {
            $this->store_file_photos($photos, $captions, $patient->id);
        }
      
        if ($request->prescription != ""){
            $prescription = new prescription;
            $prescription->name = $request->prescription;
            $prescription->patient_id = $patient->id;
            $prescription->admin_id = Auth::id();
            $prescription->save();
        }
        
        if ($request->comment != ""){
            $comment = new comment;
            $comment->content = $request->comment;
            $comment->patient_id = $patient->id;
            $comment->admin_id = Auth::id();
            $comment->save();
        }
        $patient_files = new FileResource($patient);
        // return array_values([$patient_files]);
        foreach ($patient_files as $file){
            return $file;
        }

        // $files = new FileResource($patient);

        // $file = $this->create_file($patient);
        // foreach($files as $file) {
            // print_r($file);
        // }
        // return "";
        // return view('admin.patient.file', compact('patient', 'files'));
    }
}