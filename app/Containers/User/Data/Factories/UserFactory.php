<?php

use App\Containers\User\Models\User;

// User
$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name'              => $faker->name,
        'email'             => $faker->email,
        'password'          => bcrypt('tester'),
    ];
});

// ...
