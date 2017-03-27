---
title: "Authorization"
category: "Features"
order: 3
---

apiato provides a Role-Based Access Control (RBAC) from it's Authorization Container.

Behind the scenes apiato is using the [Laravel's authorization](https://laravel.com/docs/5.4/authorization) functionality that was introduced in version 5.1.11 with the helper package [laravel-permission](https://github.com/spatie/laravel-permission). So you can always refer to the correspond documentation for more information.

## How it works

 Authorization in apiato is very simple and easy.

1) First you need to make sure you have a seeded Super Admin, an `admin` role and optionally your custom permissions. apiato provides most of these stuff for you, you can find the code at any container `.../Data/Seeders/*` directory *(example: Authentication Container)*.

2) Start creating users, assign them to new created roles and give them some permissions. All that should be done from your admin panel (built by you) which consumes the default provided API endpoints, of the Roles & Permissions (Create Role, Assign User to Roles, List all Permission...).

3) Finally you need to protect your endpoints by checking if a user has the right roles & permissions to access it. The right place to do that is the Requests class.

**Example checking if user can delete a user:** 

```php
<?php

namespace App\Containers\User\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

class DeleteUserRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permission' => 'delete-users|another-permissions..'
	      	'roles'      => 'manger'
	    ];
	
	    public function authorize()
        {
            return $this->check([
                'hasAccess|isOwner',
                'isKing',
            ]);
        }
	}
``` 

**For detailed explanation of this example, please visit the [Requests](doc:requests) Page.**

## Assign Roles & Permission to the Testing User:

You will need to set `$access` property in your test class, check out the [Tests Helpers](doc:tests-helpers) page for more details.

## Seeding some users (Admins):

By default **apiato** comes with a `Super Admin` with Access to Admin Dashboard and some default permissions. This Super Admin Credentials are:

+ email: admin@admin.com

+ password: admin

Checkout each container seeding directory `app/Containers/{container-name}/Data/Seeders/`, to edit the default **Admins**, **Roles** and **Permissions**.

## No access response:

If you don't have the right permission to access a protected Endpoint by default you will get:

```
{
   message: "403 Forbidden",
   status_code: 403
}
```
