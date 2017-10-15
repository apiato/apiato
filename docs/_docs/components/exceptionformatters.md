---
title: "Exception-Formatters"
category: "Optional Components"
order: 16
---

* [Definition](#definition)
- [Own Formatters](#own-formatters)
  - [Registering Own Formatters](#registering-own-formatters)


<a name="definition"></a>
### Definition

Apiato allows you to format the Exceptions as you like. Therefore, Apiato relies on [Heimdal](https://github.com/esbenp/heimdal), which 
basically provides the required features.

Apiato already provides basic `ExceptionFormatters` for outputting `Exceptions` in a common format. However, depending on your
response format (e.g., `JSON API`), you may change the provided formatters.

<a name="own-formatters"></a>

## Own Formatters

Apiato lets you define own formatters or override / enhance the already existing ones. Therefore, all Formatters live in
`App/Ship/Exceptions/Formatters`. 
Currently, Apiato provides formatters to format basic Exceptions (or HTTP Exceptions) as well as "common" Exceptions like `AuthenticationException` and so on.

`ExceptionFormatters` behave similar to [`Transformers`]({{ site.baseurl }}{% link _docs/components/transformers.md %}), 
i.e., they `transform` an `Exception` to a well-defined structure (e.g., array).

Take a look at the `ExceptionFormatter` and `HttpExceptionFormatter` to see the basic idea behind this. The `HttpExceptionFormatter`
extends the `ExceptionFormatter` by adding an additional `http_status` field to the latter.

Say you want to create your own `AwesomeExceptionFormatter`, simply `extend` (or copy/paste) one of the already 
provided `Formatters` and adjust the structure to your needs.

<a name="registering-own-formatters"></a>

### Registering Own Formatters

In order to tell Apiato to use your new `AwesomeExceptionFormatter` you need to `register` it. This can be done in the 
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

When throwing an `Exception` with `throw new XException()` the new `AwesomeExceptionFormatter` is used to format the `Exception` respectively.

