<?php

use App\Models\Patient;
use App\Models\admin;
use App\Models\prescription;
use Faker\Generator as Faker;

$factory->define(prescription::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'content' => $faker->paragraph,
        'patient_id' => function() {
        	return Patient::all()->random();
        },
        'admin_id' => function() {
        	return admin::all()->random();
        },
    ];
});
