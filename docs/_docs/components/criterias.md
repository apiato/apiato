---
title: "Criterias"
category: "Optional Components"
order: 20
---

### Definition

Criterias are classes used to hold and apply query condition when retrieving data from the database through a Repository.

Without using a Criteria class, you can add your query conditions to a Repository or to a Model as scope. But with Criterias, your query conditions can be shared across multiple Models and Repositories. It allows you to define the query condition once and use it anywhere in the App.

## Principles

- Every Container MAY have its own Criterias. However, shared Criterias SHOULD be created in the Ship layer.

- A Criteria MUST not contain any extra code, if it needs data, the data SHOULD be passed to it from the Actions or the Task. It SHOULD not run (call) any Task for data.

### Rules

- All Criterias MUST extend from `App\Ship\Parents\Criterias\Criteria`.

- Every Criteria SHOULD have an `apply()` function.

- A simple query condition example `"where user_id = $id"`, this can be named "This User Criteria", and used with all Models who has relations with the User Model.

### Folder Structure

```
 - app
    - Containers
        - {container-name}
            - Data
                - Criterias
                  - ColourRedCriteria.php
                  - RaceCarsCriteria.php
                  - ...
    - Ship
        - Features
            - Criterias
               - Eloquent
                  - CreatedTodayCriteria.php
                  - NotNullCriteria.php
                  - ...
```

### Code Samples

**Example: a shared Criteria** 

```php
<?php

namespace App\Ship\Features\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class OrderByCreationDateDescendingCriteria extends Criteria
{
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->orderBy('created_at', 'desc');
    }
}
```

**Usage from `Task`:** 

```php
<?php

public function run()
{
    $this->userRepository->pushCriteria(new OrderByCreationDateDescendingCriteria);

    $users = $this->userRepository->paginate();

    return $users;
} 
```

**Example: `Criteria` accepting data input:** 

```php
<?php

namespace App\Ship\Features\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class ThisUserCriteria extends Criteria
{

    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('user_id', '=', $this->userId);
    }
}
```
	
	 
**Example: Passing data from `Task` to `Criteria`:** 

```php
<?php

public function run($user)
{
    $this->accountRepository->pushCriteria(new ThisUserCriteria($user->id));

    $accounts = $this->accountRepository->paginate();

    return $accounts;
} 

```

For more information about the Criteria read [this](https://github.com/andersao/l5-repository#create-a-criteria).
