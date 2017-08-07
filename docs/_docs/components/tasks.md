---
title: "Tasks"
category: "Main Components"
order: 5
---

### Definition & Principles

Read from the [**Porto SAP Documentation (#Tasks)**](https://github.com/Mahmoudz/Porto#Tasks).

### Rules

- All Tasks MUST extend from `App\Ship\Parents\Tasks\Task`.

### Folder Structure

```
 - app
    - Containers
        - {container-name}
            - Tasks
                - ConfirmUserEmailTask.php
                - GenerateEmailConfirmationUrlTask.php
                - SendConfirmationEmailTask.php
                - ValidateConfirmationCodeTask.php
                - SetUserEmailTask.php
                - ...
```

### Code Sample

**Find User Task by ID:** 

```php
<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindUserByIdTask extends Task
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function run($id)
    {
        try {
            $user = $this->userRepository->find($id);
        } catch (Exception $e) {
            throw new UserNotFoundException();
        }

        return $user;
    }

}
```

	 
**Tasks usage from an Action:** 

```php
<?php

namespace App\Containers\Email\Actions;

use App\Containers\Email\Tasks\ConfirmUserEmailTask;
use App\Containers\Email\Tasks\ValidateConfirmationCodeTask;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;

class ValidateUserEmailByConfirmationCodeAction extends Action
{
    private $validateConfirmationCodeTask;

    private $findUserByIdTask;

    private $confirmUserEmailTask;

    public function __construct(
        ValidateConfirmationCodeTask $validateConfirmationCodeTask,
        FindUserByIdTask $findUserByIdTask,
        ConfirmUserEmailTask $confirmUserEmailTask
    ) {
        $this->validateConfirmationCodeTask = $validateConfirmationCodeTask;
        $this->findUserByIdTask = $findUserByIdTask;
        $this->confirmUserEmailTask = $confirmUserEmailTask;
    }

    public function run($userId, $code)
    {
        $this->validateConfirmationCodeTask->run($userId, $code);
        $user = $this->findUserByIdTask->run($userId);
        $this->confirmUserEmailTask->run($user);
        ...
    }
}
	 
```


