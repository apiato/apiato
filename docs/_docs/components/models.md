---
title: "Models"
category: "Main Components"
order: 10
---

- [Definition & Principles](#definition-principles)
- [Rules](#rules)
- [Folder Structure](#folder-structure)
- [Casts](#casts)
- [Code Sample](#code-sample)

<a name="definition-principles"></a>

### Definition & Principles

Read from the [**Porto SAP Documentation (#Models)**](https://github.com/Mahmoudz/Porto#Models).

<a name="rules"></a>

### Rules

- All Models MUST extend from `App\Ship\Parents\Models\Model`.
- If the name of a model differs from the Container name you have to set the `$container` attribute in the repository - [more details]({{ site.baseurl }}{% link _docs/components/repositories.md %}).

<a name="folder-structure"></a>

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

<a name="casts"></a>

### Casts
The casts attribute can be used to parse any of the model's attributes to a specific type. In the code sample below we can cast `total_credits` to `float`.

More information about the applicable cast-types can be found in the laravel [eloquent-mutators](https://laravel.com/docs/5.5/eloquent-mutators) documentation.

You can place any dates inside of the `$dates` to parse those automatically.

<a name="code-sample"></a>

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
