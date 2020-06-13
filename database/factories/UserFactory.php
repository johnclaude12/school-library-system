<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\User;
use Faker\Generator as Faker;
use App\Model\SecurityQuestion;
use App\Model\UserType;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    $randomDate = rand(2000, 2016) ."-". rand(01, 12) ."-". rand(01, 28);

    return [
        'user_type_id' => function() {
            return UserType::all()->random();
        },
        'firstname' => $faker->firstName('male'|'female'),
        'middlename' => $faker->lastName,
        'lastname' => $faker->lastName,
        'gender' => $faker->randomElement(['male', 'female']),
        'contact_no' => $faker->numberBetween(9827348348,19827348348),
        'birthday' => $randomDate,
        'username' => $faker->userName .Str::random(4),
        'email' => Str::random(7).'@example.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'question_id' => function() {
            return SecurityQuestion::all()->random();
        },
        'security_answer' => 'beauty',
        'status' => 1,
        'user_image' => 'luffy.gif',
        'remember_token' => Str::random(10),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];
});
