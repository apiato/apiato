---
title: "Models"
category: "Main Components"
order: 10
---

### Definition & Principles

Read from the [**Porto SAP Documentation (#Models)**](https://github.com/Mahmoudz/Porto#Models).

### Rules

- All Models MUST extend from `App\Ship\Parents\Models\Model`.

### Folder Structure

```
 - App
    - Containers
        - {container-name}
            - Models
                - User.php
                - UserId.php
                - ...
```

### Casts
The casts attribute can be used to parse any of the model's attributes to a specific type. In the code sample below we can cast `total_credits` to `float`.

Mor information about the applicable cast-types can be found in the laravel docs under: [eloquent-mutators](https://laravel.com/docs/5.4/eloquent-mutators).


### Code Sample

**Tags Container `Model`:**

```php
<?php

namespace App\Containers\Demo\Models;

use App\Ship\Parents\Models\Model;

class Demo extends Model
{
    protected $table = 'demos';

    protected $fillable = [
        'label',
        'user_id'
    ];

    protected $hidden = [
        'token',
    ];

    protected $casts = [
        'total_credits'     => 'float',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Containes\User\Models\User::class);
    }
}
```

Notice the Tag Model has a relationship with User Model, that is in another Module.
