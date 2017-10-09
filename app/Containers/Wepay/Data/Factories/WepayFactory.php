<?php

use App\Containers\Wepay\Models\WepayAccount;

$factory->define(WePayAccount::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name()
    ];
});

