---
title: "Requests Monitor"
category: "Features"
order: 20
---

apiato provides a simple and easy way to monitor and log all the HTTP requests coming to your application.

The request monitor can be very useful when testing and debugging your frontend Apps who consumes your API. Especially when the frontend apps (Mobile, Web,..) are built by other developers who are far from you.

The requests monitor is provided by the Debugger Container, by a `RequestsMonitorMiddleware` middleware.

## Enable requests logging

From the `.env` file set `REQUESTS_DEBUG` to true.

Now in order for this start display the results you need to enable the debugging mode in Laravel by setting `APP_DEBUG` to true in the `.env` as well.

## Usage

Simply tail the log file

```shell

tail -f storage/logs/debugger.log

```

## Result

Screenshot example:

![](https://files.readme.io/25bf091-requests-debugger.png)


## Change the default log file

By default everything is logged in the `debugger.log` file, to change the default file go to 

`Debugger/Configs/debugger.php` config file and set the file name:

```php
<?php

/*

 |--------------------------------------------------------------------------
 | Log File
 |--------------------------------------------------------------------------
 |
 | What to name the log file in the `storage/log` path.
 |
 */
 
'log_file' => 'debugger.log',

```

This feature is provided by the `Debugger` Container via its `RequestsMonitorMiddleware` middleware.

To see the results go ahead and Tail the default Laravel debug file `tail -f storage/logs/laravel.log`.

Note: this will also not run in Testing environments, to enable it you need to manually edit the Middleware.
