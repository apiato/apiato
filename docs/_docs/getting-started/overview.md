---
title: "Overview"
category: "Getting Started"
order: 3
---

<a name="Quick-Overview"></a>
## Quick Overview


### The basic flow

When an HTTP request is received, it first hits your predefined Endpoint (each endpoint live in its own Route file).

#### Sample Route Endpoint

```php
<?php
$router->get('hello', [
    'uses' => 'Controller@sayHello',
]);
```

After the user makes a request to the endpoint `[GET] www.api.apiato.com/v1/hello` it calls the defined controller function (`sayHello`).

#### Sample Controller Function

```php
<?php
class Controller extends ApiController
{
	public function sayHello(SayHelloRequest $request)
	{
            $helloMessage = $this->call(SayHelloAction::class);
	    
            $this->json([
                $helloMessage
            ]);
	}
}
```

This function takes a Request class `SayHelloRequest` to automatically checks if the user has the right access to this endpoint. _Only if the user has access, it proceed to the function body._

Then the function calls an Action (`SayHelloAction`) to perform the business logic.

#### Sample Action

```php
<?php
class SayHelloAction extends Action
{
	public function run()
	{
	    return 'Hello World!';
	}
}
```

The Action can do anything then return a result (could be Object, String or anything). 

When the Action finish its job the controller function gets ready to build a response.

Json responses can be built using the helper function `json` (`$this->json(['foo' => 'bar']);`).

#### Sample User Response

```json
[
    "Hello World!"
]
```
