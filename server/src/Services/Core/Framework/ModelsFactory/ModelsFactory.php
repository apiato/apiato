<?php
// User
$factory->define(Mega\Modules\User\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name'     => $faker->name,
        'email'    => $faker->email,
        'password' => bcrypt(str_random(10)),
    ];
});

// Account
$factory->define(Mega\Modules\Account\Models\Account::class, function (Faker\Generator $faker) {
    return [
        'user_id'  => factory(Mega\Modules\User\Models\User::class)->create()->id,
        'url'      => $faker->url,
        'username' => $faker->userName,
        'secret'   => $faker->password(),
        'note'     => $faker->text(100),
    ];
});

// Tag
$factory->define(Mega\Modules\Tag\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(Mega\Modules\User\Models\User::class)->create()->id,
        'label'   => $faker->unique()->streetName,
    ];
});

// ...
