---
title: "Overview"
category: "Getting Started"
order: 3
---

* [Quick Overview](#Quick-Overview)
  * [Option 1: The basic flow](#basic-flow)
  * [Option 2: Sample Route Endpoint](#sample-route)
  * [Option 3: Sample Controller Function](#control-fun)
  * [Option 3: Sample Action](#sample-action)
  * [Option 3: Sample User Response](#user-res)


<a name="Quick-Overview"></a>
## Quick Overview

<a name="basic-flow"></a>
### The basic flow

When an HTTP request is received, it first hits your predefined Endpoint (each endpoint live in its own Route file).
<a name="sample-route"></a>
#### Sample Route Endpoint

```php
<?php
$router->get('hello', [
    'uses' => 'Controller@sayHello',
]);
```

After the user makes a request to the endpoint `[GET] www.api.apiato.com/v1/hello` it calls the defined controller function (`sayHello`).
<a name="control-fun"></a>
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
<a name="sample-action"></a>
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
<a name="user-res"></a>
#### Sample User Response

```json
[
    "Hello World!"
]
```
