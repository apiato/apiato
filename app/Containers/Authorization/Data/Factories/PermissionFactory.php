<?php

// User
use App\Containers\Authorization\Models\Permission;

$factory->define(Permission::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->slug,
    ];
});

// ...
