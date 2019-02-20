<?php

use Faker\Generator as Faker;
use App\Admin;
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

$factory->define( App\Admin::class, function (Faker $faker) {
    return [

        'user_name' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('admin'), // secret
        'remember_token' => str_random(10),
    ];
});
