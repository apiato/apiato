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
