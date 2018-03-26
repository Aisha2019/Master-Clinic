<?php

// get home page route (it must be added to controller later)
Route::get('/', function () {
    return view('user.index');
});

// patient routes
include 'patientRoutes.php';

// admin routes
include 'adminRoutes.php';

// Nurse routes
include 'nurseRoutes.php';
