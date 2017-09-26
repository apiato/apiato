<?php

use App\Containers\Stripe\Models\StripeAccount;

$factory->define(StripeAccount::class, function (Faker\Generator $faker) {
    return [
        'customer_id' => $faker->text(10),
    ];
});

