<?php

// User
use App\Containers\Authorization\Models\Role;

$factory->define(Role::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->slug,
    ];
});

// ...
