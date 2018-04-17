<?php

use App\Models\Patient;
use App\Models\admin;
use App\Models\clinic;
use App\Models\nurse;
use App\Models\receipt;
use Faker\Generator as Faker;

$factory->define(receipt::class, function (Faker $faker) {
    return [
        'clinic_id' => function() {
        	return clinic::all()->random();
        },
        'nurse_id' => function() {
        	return nurse::all()->random();
        },
        'admin_id' => function() {
        	return admin::all()->random();
        },
        'patient_id' => function() {
        	return Patient::all()->random();
        },
        'day' => $faker->dateTime('now'),
        'total_price' => $faker->numberBetween(100, 1000),
        'discount' => $faker->numberBetween(.01, .90),
        'tax' => $faker->numberBetween(.01, .90),
    ];
});
