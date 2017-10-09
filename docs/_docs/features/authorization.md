---
title: "Authorization"
category: "Features"
order: 4
---

- [How it works](#how-it-works)
- [Responses](#responses)
- [Assign Roles & Permission to the Testing User](#assign-roles-permission-to-the-testing-user)
- [Seeding some users (Admins)](#seeding-some-users-admins)
- [Roles & Permissions guards](#Roles-Permissions-guards)


<br >
<br >
apiato provides a Role-Based Access Control (RBAC) from it's Authorization Container.

Behind the scenes apiato is using the [Laravel's authorization](https://laravel.com/docs/5.4/authorization) functionality that was introduced in version 5.1.11 with the helper package [laravel-permission](https://github.com/spatie/laravel-permission). So you can always refer to the correspond documentation for more information.

<a name="how-it-works"></a>

## How it works

Authorization in apiato is very simple and easy.

1) First you need to make sure you have a seeded Super Admin, an `admin` role and optionally your custom permissions (usually permissions should be statically created in the code). **apiato** provides most of these stuff for you, you can find the code at any container `.../Data/Seeders/*` directory *(example: Authentication Container)*.

2) Second create Roles, and attach some permissions to the roles.

3) Now start creating users (or use existing users), to assign them to the new created Roles.

*That should be done from your custom admin panel, which can consume the default provided Roles & Permissions API endpoints (Create Role, Assign User to Roles, List all Permission...).*

3) Finally you need to protect your endpoints by Permissions (or/and Roles). The right place to do that is the Requests class.

**Example protecting the (delete user) endpoint with `delete-users` permission:**

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
        'permissions' => 'delete-users',
        'roles'       => '',
    ];


    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->check([
            'hasAccess|isOwner',
        ]);
    }
}

```


**For detailed explanation of this example, please visit the [Requests]({{ site.baseurl }}{% link _docs/components/requests.md %}) Page.**

<a name="responses"></a>

## Responses

**Authorization failed JSON response:**

```json
{
  "errors": "You have no access to this resource!",
  "status_code": 403,
  "message": "This action is unauthorized."
}
```

<a name="assign-roles-permission-to-the-testing-user"></a>
## Assign Roles & Permission to the Testing User

You will need to set `$access` property in your test class, check out the [Tests Helpers]({{ site.baseurl }}{% link _docs/miscellaneous/tests-helpers.md %}) page for more details.


<a name="seeding-some-users-admins"></a>
## Seeding some users (Admins)

By default **apiato** comes with a `Super Admin` with Access to Admin Dashboard. 

This Super Admin Credentials are:

+ email: admin@admin.com
+ password: admin

This Admin seeded by `app/Containers/Authorization/Data/Seeders/AuthorizationDefaultUsersSeeder_3.php`. 

The Default Super User, has a default role `admin`.

The `admin` default role **has no permissions given to it**. 

To give permissions to the `admin` role (or any other role), you can use the dedicated endpoints (from your custom Admin Interface) or use this command `php artisan apiato:permissions:toRole admin` to give it all the permissions in the system.

Checkout each container **Seeders** directory `app/Containers/{container-name}/Data/Seeders/`, to edit the default **Users**, **Roles** and **Permissions**.

<a name="Roles-Permissions-guards"></a>
## Roles & Permissions guards

By default Apiato uses a single guard called `web` for all it's roles and permissions, you can add/edit this behavior and support multiple guards at any time. Refer to the [laravel-permission](https://github.com/spatie/laravel-permission#using-multiple-guards) package for more details.




