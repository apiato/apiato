---
title: "ETag"
category: "Features"
order: 102
---

## ETag Middleware
Apiato provides an ETag Middleware (`app/Ship/Middlewares/Http/ProcessETagHeadersMiddleware.php`) that implements the Shallow technique. 
It can be used to reduce bandwidth on the client side (especially for Mobile devices).

By default the feature is disabled. To enable it go to `app/Ship/Configs/apiato.php` and set `use-etag` to `true`. 
Of course your client should send the `If-None-Match` HTTP Header `(= etag)` in his request for this feature to work properly.
