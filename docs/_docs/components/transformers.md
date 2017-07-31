---
title: "Transformers"
category: "Main Components"
order: 12
---

### Definition & Principles

Read from the [**Porto SAP Documentation (#Transformers)**](https://github.com/Mahmoudz/Porto#Transformers).

### Rules

- All API responses MUST be formatted via a Transformer.

- Every Transformer SHOULD extend from `App\Ship\Parents\Transformers\Transformer`.

- Each Transformer MUST have a `transform()` function.

### Folder Structure

```
 - app
    - Containers
        - {container-name}
            - UI
                - API
                    - Transformers
                        - UserTransformer.php
                        - ...
```

### Code Samples

**Reward Transformer with Country relation:** 

```php
<?php

namespace App\Containers\Item\UI\API\Transformers;

use App\Containers\Item\Models\Item;
use App\Ship\Parents\Transformers\Transformer;

class ItemTransformer extends Transformer
{

    protected $availableIncludes = [
        'images',
    ];

    protected $defaultIncludes = [
        'roles',
    ];

    public function transform(Item $item)
    {
        $response = [
            'object'      => 'Item',
            'id'          => $item->getHashedKey(),
            'name'        => $item->name,
            'description' => $item->description,
            'price'       => (float)$item->price,
            'weight'      => (float)$item->weight,
            'created_at'  => $item->created_at,
            'updated_at'  => $item->updated_at,
        ];

        // add more or modify data for Admins only
        $response = $this->ifAdmin([
            'real_id'    => $user->id,
            'deleted_at' => $user->deleted_at,
        ], $response);

        return $response;
    }

    public function includeImages(Item $item)
    {
        return $this->collection($item->images, new ItemImageTransformer());
    }

    public function includeRoles(User $user)
    {
        return $this->collection($user->roles, new RoleTransformer());
    }
}
```

	 
**Usage from Controller (Single Item)** 

```php
<?php

// getting any Model
$user = $this->getUser();

// building the response with the transformer of the Model
$this->response->item($user, new UserTransformer());

// in case of collection of data
$this->response->collection($user, new UserTransformer());

// in case of Array
$this->response->array([
    'custom_field'  =>  'whatever',
    'email'         =>  $user->email,
]);

// more options are available 
```

**Usage from Controller (Multiple Items/Collection)** 

```php
<?php

// getting many Models Paginated
$rewards = $this->getRewards();

// building the response with the transformer of the Model
return $this->response->paginator($rewards, new RewardTransformer()); 

```

### Relationships

Loading relationships with the Transformer (calling other Transformers):

This can be done in 2 ways: 

1. By the User, he can specify what to relations to return in the response.

2. By the Developer, define what relations to include at run time.

#### From Front-end

You can request data with their relationships directly from the API call using `include=tags,user`. But first the Transformer need to have the `availableIncludes` defined with their functions like this:

```php
<?php

namespace App\Containers\Account\UI\API\Transformers;

use App\Ship\Parents\Transformers\Transformer;
use App\Containers\Account\Models\Account;
use App\Containers\Tag\Transformers\TagTransformer;
use App\Containers\User\Transformers\UserTransformer;

class AccountTransformer extends Transformer
{
    protected $availableIncludes = [
        'tags',
        'user',
    ];

    public function transform(Account $account)
    {
        return [
            'id'       => (int)$account->id,
            'url'      => $account->url,
            'username' => $account->username,
            'secret'   => $account->secret,
            'note'     => $account->note,
        ];
    }

    public function includeTags(Account $account)
    {
        // use collection with `multi` relationship
        return $this->collection($account->tags, new TagTransformer());
    }

    public function includeUser(Account $account)
    {
        // use `item` with single relationship
        return $this->item($account->user, new UserTransformer());
    }

}
```
	 
Now to get the `Tags` with the response when Accounts are requested pass the `?include=tags` parameter with the [GET] request.

To get Tags with User use the comma separator: `?include=tags,user`.

## From Back-end

From the controller you can dynamically set the `DefaultInclude` using (`setDefaultIncludes`) anytime you want.

```php
<?php

return $this->response->paginator($rewards, (new ProductsTransformer())->setDefaultIncludes(['tags']));
	
```

	 
You need to have `includeTags` function defined on the transformer. Look at the full examples above.

If you want to include a relation with every response from this transformer you can define the relation directly in the transformer on (`$defaultIncludes`)

```php
<?php

protected $availableIncludes = [
    'users',
];

protected $defaultIncludes = [
    'tags',
];

// .. 
```

You need to have `includeUser` and `includeTags` functions defined on the transformer. Look at the full examples above.

## Transformer Available helper functions:

- `user()` : returns current authenticated user object.

- `ifAdmin($adminResponse, $clientResponse)` : merges normal client response with the admin extra or modified results, when current authenticated user is Admin.

For more information about the Transformers read [this](http://fractal.thephpleague.com/transformers/).
