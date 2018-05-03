<?php

// get home page route (it must be added to controller later)
Route::get('/', 'Patient\HomeController@home');


// patient routes
include 'patientRoutes.php';


// admin routes
include 'adminRoutes.php';

// Nurse routes
include 'nurseRoutes.php';
