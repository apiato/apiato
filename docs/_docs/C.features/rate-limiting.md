---
title: "Rate Limiting"
category: "Features"
order: 16
---

**apiato** uses the default Laravel middleware for rate limiting (throttling).

All REST API requests are throttled to prevent abuse and ensure stability. 
The exact number of calls that your application can make per day varies based on the type of request you are making.

The rate limit window is `1` minutes per endpoint, with most individual calls allowing for `30` requests in each window.

*In other words, each user is allowed to make `30` calls per endpoint every `1` minutes. (For each unique access token).*



To update these values go to `apiato.php` config file, or to the `ENV` file.

```php
/*
|--------------------------------------------------------------------------
| Rate Limit
|--------------------------------------------------------------------------
|
| Attempts per minutes.
| `throttle_attempts` the number of attempts per `throttle_expires` in
| minutes.
|
*/
'throttle_attempts' => env('API_RATE_LIMIT_ATTEMPTS', '30'),
'throttle_expires' => env('API_RATE_LIMIT_EXPIRES', '1'),
```

```php
API_RATE_LIMIT_ATTEMPTS=30
API_RATE_LIMIT_EXPIRES=1
```

For how many hits you can preform on an endpoint, you can always check the header:

```
X-RateLimit-Limit →30
X-RateLimit-Remaining →29
```

