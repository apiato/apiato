<?php

use Symfony\Component\HttpKernel\Exception as SymfonyException;

return [
    'add_cors_headers' => false,

    // Has to be in prioritized order, e.g. highest priority first.
    'formatters' => [
        // insert your custom Exception Formatters here!


        // Apiato Exception Formatters below
        \Illuminate\Validation\ValidationException::class => \App\Ship\Exceptions\Formatters\ValidationExceptionFormatter::class,
        SymfonyException\UnprocessableEntityHttpException::class => \App\Ship\Exceptions\Formatters\UnprocessableEntityHttpExceptionFormatter::class,
        Illuminate\Auth\AuthenticationException::class => \App\Ship\Exceptions\Formatters\AuthenticationExceptionFormatter::class,
        Illuminate\Auth\Access\AuthorizationException::class => \App\Ship\Exceptions\Formatters\AuthorizationExceptionFormatter::class,
        SymfonyException\MethodNotAllowedHttpException::class => \App\Ship\Exceptions\Formatters\MethodNotAllowedExceptionFormatter::class,
        SymfonyException\HttpException::class => \App\Ship\Exceptions\Formatters\HttpExceptionFormatter::class,
        Exception::class => \App\Ship\Exceptions\Formatters\ExceptionFormatter::class,
    ],

    'response_factory' => \App\Ship\Exceptions\Builders\ExceptionBuilder::class,

    'reporters' => [
        /*'sentry' => [
            'class'  => \Optimus\Heimdal\Reporters\SentryReporter::class,
            'config' => [
                'dsn' => '',
                // For extra options see https://docs.sentry.io/clients/php/config/
                // php version and environment are automatically added.
                'sentry_options' => []
            ]
        ]*/
    ],

    'server_error_production' => 'An error occurred.'
];
