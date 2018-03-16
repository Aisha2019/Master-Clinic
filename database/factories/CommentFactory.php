<?php

use App\Models\Patient;
use App\Models\admin;
use App\Models\comment;
use Faker\Generator as Faker;

$factory->define(comment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'patient_id' => function() {
        	return Patient::all()->random();
        },
        'admin_id' => function() {
        	return admin::all()->random();
        },
    ];
});
