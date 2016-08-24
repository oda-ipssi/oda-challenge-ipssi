<?php

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    $name = $faker->firstName;
    $lastName = $faker->lastName;
    return [
        'username' => strtolower($name),
        'email' =>  $name.$lastName.'@example.net',
        'password' => bcrypt('oda'),
        'firstname' => $name,
        'lastname' => $lastName,
        'address' => $faker->address,
        'zipcode' => $faker->postcode,
        'city' => $faker->city,
        'phone' => $faker->phoneNumber,
        'ip' => $faker->ipv4,
        'is_prospect' => $faker->boolean,
        'is_active' => 0,
        'validation_token' => null,
        'remember_token' => str_random(10),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Models\Data::class, function (Faker\Generator $faker) {
    $user_ids = DB::table('users')->select(array('id','username'))->get();
    $user_id = $faker->randomElement($user_ids)->id;
    $user_username = $faker->randomElement($user_ids)->username;
    $path = storage_path().'/json/'.$user_username.$user_id.'/database'.Carbon::now()->format('Y-m-d_H:i:s');
    return [
        'is_public' => $faker->boolean,
        'user_id' => $user_id,
        'path' => $path
    ];
});
