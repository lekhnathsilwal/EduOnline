<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Student::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'faculty' => 'science_and_technology',
        'program' => 'bachelor_in_conputer_engineering',
        'college' => 'acme_engineering_college',
        'profile_picture' => 'dlfkfsdfslfkjslfjsdfsdlfkj34435fg',
        'student_card' => 'dlfkfsdfslfkjslfjsdfsdlfkj34435fg',
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
