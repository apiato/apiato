---
title: "Rate limiting"
category: "Features"
order: 21
---

## Response Header with Rate Limiting:

Every response contain API Limit `X-RateLimit-Limit:100` and the remaining calls `X-RateLimit-Remaining:77`.

**Response Header example:**

```
Cache-Control:private, must-revalidate

Connection:keep-alive

Content-Type:application/json

Date:Tue, 11 Nov 2011 11:11:11 GMT

ETag:"244216122606707c90d40b45d8f85da1"

Server:nginx/1.8.0

Transfer-Encoding:chunked

X-RateLimit-Limit:100

X-RateLimit-Remaining:77

X-RateLimit-Reset:1458641529

```

## Change the default limit:

Go to `port/config/configs/hello.php` and change the `limit` value. You might as well change the `limit_expires` value.

These values will be pointing to the `.env` file so go there and update those default variables:

```
API_LIMIT=100

API_LIMIT_EXPIRES=5

```

More details [here](https://github.com/dingo/api/wiki/Rate-Limiting)
