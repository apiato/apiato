---
title: "Requests"
category: "Components"
order: 3
---

### Definition & Principles

Read from the [**Porto SAP Documentation (#Requests)**](https://github.com/Mahmoudz/Porto#Requests).

### Rules

- All Requests MUST extend from `App\Ship\Parents\Requests\Request`.

- A Request MUST have a `rules()` function, returning an array. And an `authorize()` function to check for authorization (can return true when no authorization required).

### Folder Structure

```
 - app
    - Containers
        - {container-name}
            - UI
                - API
                    - Requests
                        - UpdateUserRequest.php
                        - DeleteUserRequest.php
                        - ...
                - WEB
                    - Requests
                        - UpdateUserRequest.php
                        - DeleteUserRequest.php
                        - ...
```

### Code Samples

**Example: Update User Requests** 

```php
<?php

namespace App\Containers\User\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

class UpdateUserRequest extends Request
{

    protected $access = [
        'permission' => '',
        'roles'      => 'admin',
    ];

    protected $decode = [

    ];

    protected $urlParameters = [

    ];

    public function rules()
    {
        return [
            'email'    => 'email|unique:users,email',
            'password' => 'min:100|max:200',
            'name'     => 'min:300|max:400',
        ];
    }

    public function authorize()
    {
        return $this->check([
            'hasAccess|isOwner',
        ]);
    }
}
```
	 
*If you are wondering what are those properties doing on the request! keep reading*

**Usage from Controller:** 

```php
<?php

public function handle(UpdateUserRequest $updateUserRequest)
{
    $data = $updateUserRequest->all();
    // or
    $name = $updateUserRequest->name;
    // or     
    $name = $updateUserRequest['name'];
} 
```

By just injecting the request class you already applied the validation and authorization rules.

### Request Properties

apiato adds some new properties to the Request Class. Each of these properties is very useful for some situations, and let you achieve your goals faster and cleaner. Below we'll see description for each property:

### **decode**

The **$decode** property is used for decoding Hashed ID's from any Request on the fly

If you have enabled the HashID feature, that apiato provide out of the box. Most probably you are passing or allowing your users to pass Hashed (encoded) ID's into your application.

Thus these ID's needs to be Decoded somewhere, apiato has a property on its Requests Components where you can specify those Hashed ID's in order to decode them before applying the validation rules.

Example:

```php
<?php

namespace App\Containers\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

class AssignUserToRoleRequest extends Request
{

    protected $decode = [
        'user_id',
        'item_id',
    ];

    public function rules()
    {
        return [

        ];
    }

    public function authorize()
    {
        return $this->check([
            // ..
        ]);
    }
}
```

	 
**Note:** validations rules that relies on your ID like (`exists:users,id`) will not work unless you decode your ID before passing it to the validation.

### **urlParameters**

The **$urlParameters** property is used for applying validation rules on the URL parameters:

Laravel by default doesn't allow validating the URL parameters (`/stores/999/items`). In order to be able to apply validation rules on URL parameters you can simply define your URL parameters in the `$urlParameters` property. This will also allow you to access those parameters form the Controller in the same way you access the Request data. 

Example: 

```php
<?php

namespace App\Containers\Email\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

class ConfirmUserEmailRequest extends Request
{

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
        'id',
        'code',
    ];

    public function rules()
    {
        return [
            'id'   => 'required|integer', // url parameter
            'code' => 'required|min:35|max:45', // url parameter
        ];
    }

    public function authorize()
    {
        return $this->check([
            // nothing! this is open endpoint.
        ]);
    }
} 
```

### **access**

The **$access** property is used by the `hasAccess` function from the `authorize` function (`check`), to check if the user has the necessaire Roles & Permissions to call this endpoint.

Example:

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
        'permission' => 'delete-users|another-permissions..'
	      	'roles'      => 'manger'
	    ];
	
	    public function authorize()
        {
            return $this->check([
                'hasAccess|isOwner',
                'isKing',
            ]);
        }
	}
	 
```


#### What's going on in the authorize!?

The `authorize` function is calling a `check` function which accepts an array of functions. Each of those functions returns a boolean.

In the example above we are calling three functions `hasAccess`, `isOwner` and `isKing`.

The separator `|` between the functions indicates an `OR` operation, so if any of the functions `hasAccess` or `isOwner` returns true the user will gain access and only when both return false the user will be prevented from accessing this endpoint.

On the other side if `isKing` *(a custom function could be written by you anywhere)* returned false no matter what all other functions returns, the user will be prevented from accessing this endpoint, because the default operation between all functions in the array is `AND`.

Checkout the [hasAccess](https://apiato.readme.io/docs/requests#section-hasaccess) below.

## Request Helper Functions

apiato also provides some helpful functions by default, so you can use them whenever you need them.

### **hasAccess**

The `hasAccess` function, decides if the the user has Access or not based on the `$access` property.

- If the user has any roles or permissions he will be given access.

- If you need more or less roles/permissions just add `|` between each permission.

- If you do not need to set a roles/permissions just set `'permission' => ''` or  `'permission' => null`.

### **isOwner**

The `hasAccess` function, checks if the passed URL ID is the same as the User ID of the request.

Example:

Let's say we have an endpoint `www.api.apiato.dev/users/{ID}/delete` that deletes a user. And we only need users to delete their own user accounts.

With `isOwner`, user of ID 1 can only call `/users/1/delete` and won't be able to call `/users/2/delete` or any other ID.
