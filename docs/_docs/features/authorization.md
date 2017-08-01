---
title: "Authorization"
category: "Features"
order: 4
---

apiato provides a Role-Based Access Control (RBAC) from it's Authorization Container.

Behind the scenes apiato is using the [Laravel's authorization](https://laravel.com/docs/5.4/authorization) functionality that was introduced in version 5.1.11 with the helper package [laravel-permission](https://github.com/spatie/laravel-permission). So you can always refer to the correspond documentation for more information.

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

### Responses

**Authorization failed JSON response:**

```json
{
  "errors": "You have no access to this resource!",
  "status_code": 403,
  "message": "This action is unauthorized."
}
```


## Assign Roles & Permission to the Testing User:

You will need to set `$access` property in your test class, check out the [Tests Helpers]({{ site.baseurl }}{% link _docs/miscellaneous/tests-helpers.md %}) page for more details.

## Seeding some users (Admins):

By default **apiato** comes with a `Super Admin` with Access to Admin Dashboard and some default permissions. This Super Admin Credentials are:

+ email: admin@admin.com
+ password: admin

Checkout each container seeding directory `app/Containers/{container-name}/Data/Seeders/`, to edit the default **Admins**, **Roles** and **Permissions**.
