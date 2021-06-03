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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user_name' => 'sandip silwal',
        'address' => 'Gongabu,Kathmandu,Nepal',
        'contact' => 9999999999,
        'engaged_college' => 'Acme Engineering College',
        'teaching_faculty' => 'science_and_technology',
        'teaching_program' => 'bachelor_in_computer_engineering',
        'citizenship' => 'dlfkfsdfslfkjslfjsdfsdlfkj34435fg',
        'teacher_card' => 'dlfkfsdfslfkjslfjsdfsdlfkj34435fg',
        'profile_picture' => 'dlfkfsdfslfkjslfjsdfsdlfkj34435fg',
        'verification' => 'notdone',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
