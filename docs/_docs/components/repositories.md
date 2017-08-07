---
title: "Repositories"
category: "Optional Components"
order: 14
---

### Definition

The Repository classes are an implementation of the Repository Design Pattern.

Their major roles are separating the business logic from the data (or the data access Task).

Repositories saves and retrieves Models to/from the underlying storage mechanism.

The Repository is used to separate the logic that retrieves the data and maps it to a Model, from the business logic that acts on the Model.

## Principles

- Every Model SHOULD have a Repository.

- A Model SHOULD always get accessed through its Repository. (Never direct access to Model).

### Rules

- All Repositories MUST extend from `App\Ship\Parents\Repositories\Repository`. Extending from this class will give access to functions like (`find`, `create`, `update` and much more).

- Repository name should be same like it's model name (model: `Foo` -> repository: `FooRepository`).

- If a Repository belongs to Model with name different than its Container name, The Repository must set `$container='ContainerName'` property. *See an example below* 

### Folder Structure

```
 - app
    - Containers
        - {container-name}
                - Data
                - Repositories
                    - UserRepository.php
                    - ...
```

### Code Samples

**User `Repository`:** 


```php
<?php

namespace App\Containers\User\Data\Repositories;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Models\User;
use App\Ship\Parents\Repositories\Repository;

class UserRepository extends Repository implements UserRepositoryInterface
{
    protected $fieldSearchable = [
        'name'  => 'like',
        'email' => '=',
    ];
}
```
	 
**Usage:** 


```php
<?php

// paginate the data by 10
$users = $userRepository->paginate(10);

// search by 1 field
$cars = $carRepository->findByField('colour', $colour);

// searching multiple fields
$offer = $offerRepository->findWhere([
    'offer_id' => $offer_id,
    'user_id'  => $user_id,
])->first();

//.... 
```

Note: If the Repository belongs to Model with a name different than its Container name, the Repository class of that Model must set the property `$container` and define the Container name.

**Example:** 


```php
<?php

namespace App\Containers\Authorization\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class RoleRepository extends Repository
{
    protected $container = 'Authorization'; // the container name. Must be set when the model has different name than the container

    protected $fieldSearchable = [

    ];

}
```	 

### Other Properties:

### API Query Parameters Property

To enable query parameters (`?search=text`,...) in your API you need to set the property `$fieldSearchable` on the Repository class, to instruct the querying on your model.

**Example `$fieldSearchable` of a `Repository`:** 

```php
	 <?php
	
	protected $fieldSearchable = [
	  'name'  => 'like',
	  'email' => '=',
	]; 
```


Continue reading to find more about those properties and what they do.

### All other Properties

apiato uses the `andersao/l5-repository` package, to provide a lot of powerful features to the repository class. such as

```php
<?php
	 
	 // ...
	 
    protected $cacheMinutes = 1440; // 1 day

    protected $cacheOnly = ['all'];

```

To learn more about all the properties you can use, visit the `andersao/l5-repository` package [documentation](https://github.com/andersao/l5-repository).
