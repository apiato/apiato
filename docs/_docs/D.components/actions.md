---
title: "Actions"
category: "Components"
order: 4
---

### Definition & Principles

Read from the [**Porto SAP Documentation (#Actions)**](https://github.com/Mahmoudz/Porto#Actions).

### Rules

- All Actions MUST extend from `App\Ship\Parents\Actions\Action`.

### Folder Structure

	 - app

	    - Containers

	        - {container-name}

	            - Actions

	                - CreateUserAction.php

	                - DeleteUserAction.php

	                - ... 

### Code Sample

**Delete User Action:** 

	 <?php

	

	namespace App\Containers\User\Actions;

	

	use App\Containers\User\Tasks\DeleteUserTask;

	use App\Ship\Parents\Actions\Action;

	

	class DeleteUserAction extends Action

	{

	

	    private $deleteUserTask;

	

	    public function __construct(DeleteUserTask $deleteUserTask)

	    {

	        $this->deleteUserTask = $deleteUserTask;

	    }

	

	    public function run($userId)

	    {

	        return $this->deleteUserTask->run($userId);

	    }

	}

But injecting each Task in the constructor and then using it below through its property is really boring and the more Tasks you use the worse it gets. So instead you can use the function `call` to call whichever Task you want and then pass any parameters to it. 

**Same Example using the `call` function:** 

	 

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

	

	

	 

**Example: Calling multiple Tasks:** 

	 <?php

	

	namespace App\Containers\Email\Actions;

	

	use App\Containers\Xxx\Tasks\Sample111Task;

	use App\Containers\Xxx\Tasks\Sample222Task;

	use App\Ship\Parents\Actions\Action;

	

	class DemoAction extends Action

	{

	    public function run($xxx, $yyy, $zzz)

	    {

	      

	         $foo = $this->call(Sample111Task::class, [$xxx, $yyy]);

	

	         $bar = $this->call(Sample222Task::class, [$foo, $zzz]);

	      

	         // ...

	    }

	}

	 

**Action usage from a Controller:** 

	 <?php

	

	    public function setUserEmailController(SetUserEmailRequest $request, SetUserEmailWithConfirmationAction $action)

	    {

	        $action->run($request->id, $request->email);

	

	        return ...

	    } 

The same Action MAY be called by multiple Controllers (Web, Api, Cli).

