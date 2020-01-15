# Heimdal

[![Latest Version](https://img.shields.io/github/release/esbenp/heimdal.svg?style=flat-square)](https://github.com/esbenp/heimdal/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/esbenp/heimdal/master.svg?style=flat-square)](https://travis-ci.org/esbenp/heimdal)
[![Coverage Status](https://img.shields.io/coveralls/esbenp/heimdal.svg?style=flat-square)](https://coveralls.io/github/esbenp/heimdal)
[![Total Downloads](https://img.shields.io/packagist/dt/optimus/heimdal.svg?style=flat-square)](https://packagist.org/packages/optimus/heimdal)

## Introduction

Heimdal is a Laravel exception handler build specifically for APIs.

### Why is it needed?

When building APIs there are specific formatting do's and dont's on how to send errors back to the user. Frameworks like Laravel are not
build specifically for API builders. This small library just bridges that gap. For instance, specifications like [JSON API](https://jsonapi.org)
have [guidelines for how errors should be formatted](http://jsonapi.org/format/#error-objects).

## Installation

```bash
composer require optimus/heimdal ~1.0
```

Add the service provider to `config/app.php`

```
// other providers...
Optimus\Heimdal\Provider\LaravelServiceProvider::class,
```

Publish the configuration.

```
php artisan vendor:publish --provider="Optimus\Heimdal\Provider\LaravelServiceProvider"
```

Add the exception handler to `bootstrap/app.php`

```
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Optimus\Heimdal\ExceptionHandler::class
);
```

## What does it do?

Imagine you have a piece of code that throws an `InvalidArgumentException`. This is a server error (500). It will parse through the flow
described below.

```
1. Exception is thrown
2. The Exception is parsed through reports. A reporter is a class that reports the Exception. Log it in logs, send to external trackers like Sentry, Bugsnag etc.
3. The Exception is parsed through an appropriate formatter that formats the response in accordance to the error type.
4. The response is sent to the user.
```

### Is this not what Laravel does?

Yes, pretty much. However, if you want to report to something like Sentry you usually do this through something like Monolog. The problem
with Monolog is that it is difficult to [pick up the response of the reporters](https://github.com/Seldaek/monolog/issues/651). For instance,
Sentry reports back a unique ID for every reported exception which is extremely useful to give to the user, so they can give it to customer
support. Heimdal supports this out-of-the-box by giving the response of all reporters to the formatter classes. This makes it trivial
for formatters to use the response of the reporters in their final response to the user.

Second, Heimdal comes with sensible defaults as how different error types should be reported to the user. And makes it trivial to implement
alternative responses for specific exception types.

## Configuration

Heimdal has two things that should be configured: formatters and reporters.

### Reporters

You should determine where your exceptions should be reported to. Heimdal still calls the base report function in Laravel, so your
exceptions will still be logged as normal. However, adding external reporting is easy. Heimdal comes with Sentry integration out of the box.
To send exceptions to Sentry simply add this entry to the `reporters` section in `config/optimus.heimdal.php`

```php
'sentry' => [
    'class'  => \Optimus\Heimdal\Reporters\SentryReporter::class,
    'config' => [
        'dsn' => '',
        // For extra options see https://docs.sentry.io/clients/php/config/
        // php version and environment are automatically added.
        'sentry_options' => []
    ]
]
```

Adding a custom reporter, for instance Bugsnag, is as simple as writing a small reporter class like this

```php
<?php

namespace My\Namespace\Exceptions\Reporters;

use Optimus\Heimdal\Reporters\ReporterInterface;

class BugsnagReporter implements ReporterInterface
{
    public function __construct(array $config)
    {
        // initialize with config
    }

    public function report(Exception $e)
    {
        // report to bugsnag
    }
}
```

And then add it to `config/optimus.heimdal.php`

```php
'bugsnag' => [
    'class'  => \My\Namespace\Exceptions\Reporters\BugsnagReporter::class,
    'config' => [
        // config.
    ]
]
```

### Formatters

Heimdal already comes with sensible formatters out of the box. In `config/optimus.heimdal.php` is a section where
the formatter priority is defined.

```php
'formatters' => [
    SymfonyException\UnprocessableEntityHttpException::class => Formatters\UnprocessableEntityHttpExceptionFormatter::class,
    SymfonyException\HttpException::class => Formatters\HttpExceptionFormatter::class,
    Exception::class => Formatters\ExceptionFormatter::class,
],
```

The higher the entry, the higher the priority. In this example, a `UnprocessableEntityHttpException` will be formatted used the
`UnprocessableEntityHttpExceptionFormatter` because it is the first entry. However, an `NotFoundHttpException` will not match
`UnprocessableEntityHttpException` but will match `HttpException` (since it is a child class hereof) and will therefore
be formatted using the `HttpExceptionFormatter`.

You can write custom formatters easily:

```php
<?php

namespace My\Namespace\Exceptions\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;
use Optimus\Heimdal\Formatters\BaseFormatter;

class NotFoundHttpExceptionFormatter extends BaseFormatter
{
    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        $response->setStatusCode(404);
        $data = $response->getData(true);

        if ($this->debug) {
            $data = array_merge($data, [
                'code'   => $e->getCode(),
                'message'   => $e->getMessage(),
                'exception' => (string) $e,
                'line'   => $e->getLine(),
                'file'   => $e->getFile()
            ]);
        } else {
            $data['message'] = [
                'message' => 'The resource was not found.',
                'log_id' => $reporterResponses['sentry']['sentry_id']
            ]
        }

        $response->setData($data);
    }
}
```

Notice how easily we used `$reporterResponses` to attach the ID of the Sentry log to the JSON response.
Now we simply add it to `config/optimus.heimdal.php`

```php
'formatters' => [
    SymfonyException\UnprocessableEntityHttpException::class => Formatters\UnprocessableEntityHttpExceptionFormatter::class,
    SymfonyException\NotFoundHttpException::class => My\Namespace\Exceptions\Formatters\NotFoundHttpExceptionFormatter::class,
    SymfonyException\HttpException::class => Formatters\HttpExceptionFormatter::class,
    Exception::class => Formatters\ExceptionFormatter::class,
],
```

Now all `NotFoundHttpException`s will be formatted using our custom formatter.

## Available Reporters

### [Sentry](https://getsentry.com)

To send Exceptions to Sentry add the following reporter configuration in `config/optimus.heimdal.php`.

```
'reporters' => [
    'sentry' => [
        'class'  => \Optimus\Heimdal\Reporters\SentryReporter::class,
        'config' => [
            'dsn' => '',
            // For extra options see https://docs.sentry.io/clients/php/config/
            // php version and environment are automatically added.
            'sentry_options' => []
        ]
    ]
]
```

#### Adding context at runtime

Sometimes you want to add information at runtime, like request data, user information or similar.
For this you can add the `add_context` key to the `config` array. Below is an example of how it could be implemented.

```
'reporters' => [
    'sentry' => [
        'class'  => \Optimus\Heimdal\Reporters\SentryReporter::class,
        'config' => [
            'dsn' => env('SENTRY_DSN'),
            // For extra options see https://docs.sentry.io/clients/php/config/
            // php version and environment are automatically added.
            'add_context' => function (Exception $e) {
                $context = [
                    'environment' => app()->environment(),
                    'release' => \Infrastructure\Version::getGitTag()
                ];

                $user = \Auth::User();
                if ($user) {
                    $context['user'] = [
                        'id' => $user->id,
                        'email' => $user->email,
                    ];
                } else {
                    $context['user'] = [];
                }

                // When running in console request is not available
                if (substr(php_sapi_name(), 0, 3) !== 'cli') {
                    $request = app('request');

                    if (!isset($context['extra'])) {
                        $context['extra'] = [];
                    }

                    $context['extra']['request_data'] = json_encode($request->all());
                    $context['user']['ip_address'] = \Request::getClientIp();
                }

                return $context;
            }
        ]
    ]
]
```

### [Bugsnag](https://bugsnag.com/)

[Thanks to Nikolaj Løvenhardt Petersen for adding support](https://github.com/nikolajlovenhardt)

[Install Bugsnag using the Laravel installation guide](https://docs.bugsnag.com/platforms/php/laravel/)

To send Exceptions to Bugsnag add the following reporter configuration in `config/optimus.heimdal.php`.

```
'reporters' => [
    'bugsnag' => [
        'class'  => \Optimus\Heimdal\Reporters\BugsnagReporter::class,
        'config' => []
    ]
]
```

### [Rollbar](https://rollbar.com)

To send Exceptions to Rollbar add the following reporter configuration in `config/optimus.heimdal.php`.

```
'reporters' => [
'rollbar' => [
        'class'  => \Optimus\Heimdal\Reporters\RollbarReporter::class,
        'config' => [
            'access_token' => '',
            'environment' => 'production'
        ]
    ]
]
```

The complete list of config options can be found in [here](https://github.com/rollbar/rollbar-php#configuration-reference)

## Standards

This package is compliant with [PSR-1], [PSR-2] and [PSR-4]. If you notice compliance oversights,
please send a patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/esbenp/heimdal/blob/master/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](https://github.com/esbenp/heimdal/blob/master/LICENSE) for more information.
