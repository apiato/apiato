---
title: "Seeders"
category: "Optional Components"
order: 24
---

### Definition

Seeders (are a short name for Database Seeders). 

Seeders are classes made to seed the database with real data, this data usually should exist in the Application after the installation (Example: the default Users Roles and Permissions or the list of Countries).

## Principles

- Seeders SHOULD be created in the Containers. (If the container is using a package that publishes a Seeder class, this class should be manually placed in the Container that make use of it. Do not reply on the package to place it on its right location).

### Rules

- Seeders should be in the right directory inside the container to be loaded.

- To avoid any conflict between containers seeders classes, you SHOULD always prepend the Seeders of each container with the container name. (Example: `UserPermissionsSeeder`, `ItemPermissionsSeeder`). *If 2 seeders classes have the same name but live in different containers, one of them will not be loaded.*

- If you wish to order the seeding of the classes, you can just append `_1`, `_2` to your classes.

### Folder Structure

```
 - App
    - Containers
        - {container-name}
             - Data
                - Seeders
                    - ContainerNameRolesSeeder_1.php
                    - ContainerNamePermissions_2.php
                    - ...
```

### Code Samples

**Roles `Seeder`:** 


```php
<?php

namespace App\Containers\Order\Data\Seeders;

use Illuminate\Support\Facades\App;
use App\Containers\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Seeders\Seeder;

class OrderPermissionsSeeder_1 extends Seeder
{

    public function run()
    {
        App::make(CreatePermissionTask::class)->run('approve-reject-orders');
        App::make(CreatePermissionTask::class)->run('find-orders');
        App::make(CreatePermissionTask::class)->run('list-orders');
        App::make(CreatePermissionTask::class)->run('update-orders');
        App::make(CreatePermissionTask::class)->run('delete-orders');

        // ...

    }
}


```


Note: Same `Seeder` class is allowed to contain seeding for multiple `Models`.

### Run the Seeders

After registering the `Seeders` you can run this command:

```shell
php artisan db:seed
```

To run specific Seeder class you can specific its class in the parameter as follow:

```shell
php artisan db:seed --class="your\single\seeder\goes-here"
```

Migrate & seed at the same time

```shell
php artisan migrate --seed
```

For more information about the Database Seeders read [this](https://laravel.com/docs/master/seeding).




## apiato testing seeder command

It's useful sometimes to create a big set of testing data. apiato facilitates this task:

1) Open `app/Ship/Seeders/Data/Testing/Seeders/TestingDataSeeder.php` and write your testing data here.

2) Run this command any time you want this data available (example at staging servers):

```shell
php artisan apiato:seed-test
```

