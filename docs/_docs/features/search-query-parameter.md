---
title: "Search Query Parameter"
category: "Features"
order: 101
---

## How it works

Below we'll see how to setup a Search Query Parameter, on a Model:

1. Add searchable Fields on the Model Repository, *all the other steps are normal steps* 

```php
<?php

namespace App\Containers\User\Data\Repositories;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Ship\Parents\Repositories\Repository;

class UserRepository extends Repository implements UserRepositoryInterface
{

    protected $fieldSearchable = [
        'name'  => 'like',
        'id'    => '=',
        'email' => '=',
    ];

}
```
	 
2. Create basic list and search Task

```php
<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Port\Action\Abstracts\Action;

class ListUsersTask extends Action
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function run($order = true)
    {
        return $this->userRepository->paginate();
    }
}
	 
```

3. Create basic Action to call that basic Task, and maybe other Tasks later in the future when needed

```php
<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\ListUsersTask;
use App\Port\Action\Abstracts\Action;

class ListAndSearchUsersAction extends Action
{

    private $listUsersTask;

    public function __construct(ListUsersTask $listUsersTask)
    {
        $this->listUsersTask = $listUsersTask;
    }

    public function run($order = true)
    {
        return $this->listUsersTask->run($order);
    }
} 

```

4. Use the Action from a Controller

```php

<?php

public function listAllUsers(ListAndSearchUsersAction $action)
{
    $users = $action->run();

    return $this->response->paginator($users, new UserTransformer());
} 

```

5. Call it from anywhere as follow: [GET] `http://api.apiato.com/users?search=Mahmoud@apiato.com`
