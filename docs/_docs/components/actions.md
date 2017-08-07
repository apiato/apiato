---
title: "Actions"
category: "Main Components"
order: 4
---

### Definition & Principles

Read from the [**Porto SAP Documentation (#Actions)**](https://github.com/Mahmoudz/Porto#Actions).

### Rules

- All Actions MUST extend from `App\Ship\Parents\Actions\Action`.

### Folder Structure

```
 - app
    - Containers
        - {container-name}
            - Actions
                - CreateUserAction.php
                - DeleteUserAction.php
                - ...
```

### Code Sample

**Delete User Action:** 

```php
<?php

namespace App\Containers\User\Actions;

use App\Containers\Authorization\Tasks\AssignUserToRoleTask;
use App\Containers\User\Tasks\CreateUserByCredentialsTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateAdminAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $admin = $this->call(CreateUserByCredentialsTask::class, [$request->email, $request->password, $request->name]);

        $this->call(AssignUserToRoleTask::class, [$admin, ['admin']]);

        return $admin;
    }
}

```

But injecting each Task in the constructor and then using it below through its property is really boring and the more Tasks you use the worse it gets. So instead you can use the function `call` to call whichever Task you want and then pass any parameters to it.


The Action itself was also called using `$this->call()` which triggers the `run` function in it. 


Refer to the **Magical Call** page for more info and examples on how to use the call function.



**Same Example using the `call` function:** 

	 
```php
<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\DeleteUserTask;
use App\Ship\Parents\Actions\Action;

class DeleteUserAction extends Action
{

    public function run($userId)
    {
        return $this->call(DeleteUserTask::class, [$userId]); // <<<<<
    }

}
```
	

**Example: Calling multiple Tasks:** 

```php
<?php

namespace App\Containers\Email\Actions;

use App\Containers\Xxx\Tasks\Sample111Task;
use App\Containers\Xxx\Tasks\Sample222Task;
use App\Ship\Parents\Requests\Request;
use App\Ship\Parents\Actions\Action;

class DemoAction extends Action
{

    public function run(Request $request)
    {

        $foo = $this->call(Sample111Task::class, [$request->xxx, $request->yyy]);

        $bar = $this->call(Sample222Task::class, [$request->foo, $request->zzz]);

        // ...

    }

}

```
	 

**Action usage from a Controller:** 

```php
 <?php
    //...

    public function deleteUser(DeleteUserRequest $request)
    {
        $user = $this->call(DeleteUserAction::class, [$request]);

        return $this->deleted($user);
    }

    //...
```

The same Action MAY be called by multiple Controllers (Web, Api, Cli).

