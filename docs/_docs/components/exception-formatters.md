---
title: "Exception Formatters"
category: "Optional Components"
order: 16
---

* [Definition](#definition)
- [Create your own Formatter](#own-formatters)
  - [Registering Your Formatters](#registering-own-formatters)


<a name="definition"></a>
## Definition


In Apiato you can format any Exception response the way you want, using the Exception Formatters (same like [`Transformers`]({{ site.baseurl }}{% link _docs/components/transformers.md %}) but for Exception Responses). 

Apiato uses the [Heimdal](https://github.com/esbenp/heimdal) package, which allows you to format your API exceptions responses using Formatter classes. 
For more details visit the package [documentation](https://github.com/esbenp/heimdal).



By default Apiato have basic `ExceptionFormatters` for outputting `Exceptions` in a good format. 

These Formatters can by modified, example: in case using the `JSON API` payloads, you may change the provided formatters to return [JSON API Error response](http://jsonapi.org/format/#error-objects) .

<a name="own-formatters"></a>

## Create your own Formatter

You can add your own formatters (or override existing ones) anytime. 

All Formatters live in `App/Ship/Exceptions/Formatters`.
 
By default Apiato provides formatters to format basic Exceptions (or HTTP Exceptions) as well as "common" Exceptions like `AuthenticationException` and so on.


#### Simple Formatter Example: 

```php
<?php

namespace App\Ship\Exceptions\Formatters;

use Apiato\Core\Exceptions\Formatters\ExceptionsFormatter as CoreExceptionsFormatter;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthorizationExceptionFormatter extends CoreExceptionsFormatter
{
    CONST STATUS_CODE = 403;
    
    public function responseData(Exception $exception, JsonResponse $response)
    {
        return [
            'code'        => $exception->getCode(),
            'message'     => $exception->getMessage(),
            'errors'      => 'You have no access to this resource!',
            'status_code' => self::STATUS_CODE,
        ];
    }

    function modifyResponse(Exception $exception, JsonResponse $response)
    {
        return $response;
    }

    public function statusCode()
    {
        return self::STATUS_CODE;
    }
}

```

- The `responseData` is where you format the response.
- The `STATUS_CODE` is the status code which will be sent in header. (`status_code` could be the same as the header code).
- The `modifyResponse` allows you to alter the response when needed. Example:

```php
<?php

    public function modifyResponse(Exception $exception, JsonResponse $response)
    {
        // append exception headers to the response headers.
        if (count($headers = $exception->getHeaders())) {
            $response->headers->add($headers);
        }

        return $response;
    }
```


<a name="registering-own-formatters"></a>

### Registering Your Formatters

In order to inform Apiato to use your new `AwesomeExceptionFormatter` you need to `register` it. This can be done in the 
`App/Ship/Configs/optimus.heimdal.php` configuration file.

Take a look at the `optimus.heimdal.formatters` key. This array defines a `key-value` list that declares a Mapping between an
`Exception` class and the corresponding `Formatter`.

Say, you want to _register_ the `AwesomeExceptionFormatter` for all `HttpExceptions` add a new line to the **top** of this array, like so:

```php
'formatters' => [
    
    SymfonyException\HttpException::class => \Your\Custom\Namespace\AwesomeExceptionFormatter::class,

    // the already defined exception formatters from Apiato
    // ...
]
```

> Note: the order of the formatters matter.

When throwing an `Exception` with `throw new XException()` the new `AwesomeExceptionFormatter` is used to format the `Exception` respectively.

