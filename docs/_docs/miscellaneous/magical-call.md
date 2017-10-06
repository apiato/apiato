---
title: "Magical Call"
category: "Miscellaneous"
order: 1
---

- [The Magical Call](#the-magical-call)
    + [Basic Usage](#basic-usage)
    + [Usage options](#Usage-options)
    + [Passing arguments to the run function](#passing-arguments-to-the-run-function)
    + [Calling other functions before the run](#calling-other-functions-before-the-run)
    + [Calling other functions and pass them arguments:](#calling-other-functions-and-pass-them-arguments)
- [Use case example:](#use-case-example)
    + [The ListUsersTask class:](#the-listuserstask-class)


<a name="the-magical-call"></a>
### The Magical Call

This magical function allows you to call any Action or Task `run` function, from any (Controller, Action, Command and Transformer).

The function `call` is mainly used for calling Apiato `Actions` from `Controllers` and for calling Apiato `Tasks` from `Actions`.

Each Action knows which UI called it using `$this->getUI()`, this is useful for handling the same Action differently based on the UI type (Web or API).

> Note: only in the case of Console Commands use the function `$this->apiatoCall(...)` instead of `$this->call(...)` , 
to avoid conflict between the Laravel default `call()` provided `Illuminate\Console\Command` and Apiato's `call()`.

<a name="Usage-options"></a>
### Usage options

In the first argument you can pass the Class full name, as follow `App\Containers\User\Tasks\CreateUserTask::class`, 
or you can pass the container name and class name, as follow `User@CreateUserTask`.

It is highly recommended to use the apiato caller style `containerName@className` as it helps removing direct dependencies between containers. 
The function will verify the Container exist before calling the function and inform the user to install Container if not exist.

Note: When a class is directly called using his full name, a warning will be logged informing you to use the "apiato caller style". 

```php
<?php

// Call "AssignUserToRoleTask" Task from the "Authorization" Container using the apiato caller style 
$this->call('Authorization@AssignUserToRoleTask');

// Call "AssignUserToRoleTask" Task from the "Authorization" Container using class full name 
$this->call(\App\Containers\Authorization\Tasks\AssignUserToRoleTask::class);
```


<a name="basic-usage"></a>
##### Basic Usage

```php
$foo = $this->call('Container@ActionOrTask');
```

<a name="passing-arguments-to-the-run-function"></a>

##### Passing arguments to the `run` function

```php
$foo = $this->call('Container@ActionOrTask', [$runArgument1, $runArgument2, $runArgument3]);
```

<a name="calling-other-functions-before-the-run"></a>

##### Calling other functions before calling the `run`

```php
$foo = $this->call('Container@ActionOrTask', [$runArgument], ['otherFunction1', 'otherFunction2']);
```

<a name="calling-other-functions-and-pass-them-arguments"></a>

##### Calling other functions and pass them arguments before calling the `run`

```php
<?php
$foo = $this->call('Container@ActionOrTask', [$runArgument], [
    [
       'function1' => ['function1-argument1', 'function1-argument2']
    ],
    [
       'function2' => ['function2-argument1']
    ],
]);

$foo = $this->call('Container@ActionOrTask', [$runArgument], [
    'function-without-argument',
    [
      'function1' => ['function1-argument1', 'function1-argument2']
    ],  
]);

$foo = $this->call('Container@ActionOrTask', [], [
    'function-without-argument',
    [
      'function1' => ['function1-argument1', 'function1-argument2']
    ],
    'another-function-without-argument',
    [
      'function2' => ['function2-argument1', 'function2-argument2', 'function2-argument3']
    ],
]);
```

<a name="use-case-example"></a>

### Use case example

```php
<?php

return $this->call('User@ListUsersTask', [], ['ordered']);
// can be called this way as well $this->call(ListUsersTask::class, [], ['ordered']);

return $this->call('User@ListUsersTask', [], ['ordered', 'clients']);

return $this->call('User@ListUsersTask', [], ['admins']);

return $this->call('User@ListUsersTask', [], ['admins', ['roles' => ['manager', 'employee']]]);
```

<a name="the-listuserstask-class"></a>

##### The ListUsersTask class

```php
<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Criterias\AdminsCriteria;
use App\Containers\User\Data\Criterias\ClientsCriteria;
use App\Containers\User\Data\Criterias\RoleCriteria;
use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Tasks\Task;

class ListUsersTask extends Task
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function run()
    {
        return $this->userRepository->paginate();
    }

    public function clients()
    {
        $this->userRepository->pushCriteria(new ClientsCriteria());
    }

    public function admins()
    {
        $this->userRepository->pushCriteria(new AdminsCriteria());
    }

    public function ordered()
    {
        $this->userRepository->pushCriteria(new OrderByCreationDateDescendingCriteria());
    }

    public function withRole($roles)
    {
        $this->userRepository->pushCriteria(new RoleCriteria($roles));
    }

}

```
