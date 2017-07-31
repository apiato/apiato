---
title: "Factories"
category: "Optional Components"
order: 25
---

### Definition

Factories (are a short name for Models Factories). 

Factories are used to generate some fake data with the help of Faker to be used for testing purposes.

Factories are mainly used from Tests.

## Principles

- Factories SHOULD be created in the Containers.

### Rules

- A Factory is just a plain PHP script. *(No classes or namespaces required)*

### Folder Structure

```
 - app
    - Containers
        - {container-name}
             - Data
                - Factories
                    - UserFactory.php
                    - ...
```

### Code Samples

**A User Model Factory:** 

```php
<?php

// User
$factory->define(App\Containers\User\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name'     => $faker->name,
        'email'    => $faker->email,
        'password' => bcrypt(str_random(10)),
    ];
});

// ...
```
	 
**Usage from `Tests` or anywhere else:** 

```php
<?php

// creating 4 users
factory(User::class, 4)->create(); 
```

**Usage with relationships:** 

```php
<?php

$countries = Country::all();

// creating 3 rewards and attaching country relation to them
$rewards = factory(Reward::class, 3)->make()->each(function ($reward) use ($countries) {
    $reward->save();
    $reward->countries()->attach([$countries->random(1)->id, $countries->random(1)->id]);
    $reward->save();
}); 
```


Use make instance of create and pass any data any way, then save after establishing the relations.

**Usage while overriding some values:** 

```php
<?php

// creating single Offer and setting a user id
$offer = factory(Offer::class)->make();
$offer->user_id = $user->id;
$offer->save();

// ANOTHER EXAMPLE: 

// creating multiple Accounts
factory(Account::class, 3)->make()->each(function ($account) use ($user) {
    $account->user_id = $user->id;
    $account->save();
}); 
```

For more information about the Models Factories read [this](https://laravel.com/docs/master/testing#model-factories).
