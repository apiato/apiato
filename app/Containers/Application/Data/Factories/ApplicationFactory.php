<?php

// User
use App\Containers\Application\Models\Application;
use App\Containers\User\Models\User;

$factory->define(Application::class, function (Faker\Generator $faker) {

    return [
        'name'    => $faker->name,
        'token'   => '1234567890',
        'user_id' => factory(User::class)->create()->id,
    ];
});

// ...
