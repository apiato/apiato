---
title: "Magical Call"
category: "Miscellaneous"
order: 1
---

### The Magical Call

This magical function allows you to call any Action's or Task's `run` function, from any Controller or Action classes.

Each Action knows which UI called it using `$this->getUI()`, this is useful when handling the same Action differently based on the UI type (Web or API).


The function is mainly used for calling APIATO `Actions` from `Controllers` as follow:

```php
$this->call(\MyAction::class, [$paramerter1, $paramerter2]);
// or you can inject the "MyAction" Class, in the parameter of the Controller function, as usual.
```


##### Basic Usage:

```php
$foo = $this->call(ActionOrTask::class);
```

##### Passing arguments to the `run` function:

```php
$foo = $this->call(ActionOrTask::class, [$runArgument1, $runArgument2, $runArgument3]);
```

##### Calling other functions before the `run`:

```php
$foo = $this->call(ActionOrTask::class, [$runArgument], ['otherFunction1', 'otherFunction2']);
```

##### Calling other functions and pass them arguments:

```php
$foo = $this->call(ActionOrTask::class, [$runArgument], [
    ['function1' => ['function1-argument1', 'function1-argument2']], 
    ['function2' => ['function2-argument1']], 
]);


$foo = $this->call(ActionOrTask::class, [$runArgument], [
    'function-without-argument',
    ['function1' => ['function1-argument1', 'function1-argument2']],  
]);

$foo = $this->call(ActionOrTask::class, [], [
    'function-without-argument',
    ['function1' => ['function1-argument1', 'function1-argument2']],
    'another-function-without-argument',
    ['function2' => ['function2-argument1', 'function2-argument2', 'function2-argument3']],
]);
```

### Use case example:

```php
<?php

return $this->call(ListUsersTask::class, [], ['ordered']);

return $this->call(ListUsersTask::class, [], ['ordered', 'clients']);

return $this->call(ListUsersTask::class, [], ['admins']);

return $this->call(ListUsersTask::class, [], ['admins', ['roles' => ['manager', 'employee']]]);
```

##### The ListUsersTask class:

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
