<?php

use Illuminate\Support\Facades\Hash;

$factory->define(App\Containers\User\Models\User::class, function (Faker\Generator $faker) {

    return [
        'name'     => $faker->name,
        'email'    => $faker->email,
        'password' => Hash::make('testing-password'),
        'is_client' => false,
    ];
});

$factory->state(App\Containers\User\Models\User::class, 'client', function ($faker) {
    return [
        'is_client' => true,
    ];
});
