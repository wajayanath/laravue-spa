<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
       'first_name' => $faker->firstName,
       'last_name' => $faker->lastName,
       'email' => $faker->unique()->safeEmail,
       'phone_number' => $faker->phoneNumber
    ];
});
