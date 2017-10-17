---
title: "API Versioning"
category: "Features"
order: 99
---

- [How it works](#How-it-works)
- [Version the API in header instead of URL](#version-my-API)


Since Laravel does not support API versioning, **apiato** provide a very easy way to implement versioning for your API.


<a name="How-it-works"></a>
### How it works

**Create:**

When creating a new API endpoint, specify the version number in the route file name following this naming format `{endpoint-name}.{version-number}.{documentation-name}.php`.

Example:

- `MakeOrder.v1.public.php`
- `MakeOrder.v2.public.php`
- `ListOrders.v1.private.php`

**Use:**

Automatically the endpoint inside that route file will be accessible by adding the version number to the URL.

Example: 

- `http://api.apiato.dev/v1/register`
- `http://api.apiato.dev/v1/orders`
- `http://api.apiato.dev/v2/stores/123`



<a name="version-my-API"></a>
## Version the API in header instead of URL

First remove the URL version prefix:

1. Edit `app/Ship/Configs/apiato.php`, set prefix to `'enable_version_prefix' => 'false',`.
2. Implement the Header versioning anyway you prefer. (this is not implemented in Apiato yet. _Consider a contribution_).
