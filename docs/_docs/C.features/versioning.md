---
title: "API Versioning"
category: "Features"
order: 99
---

Since Laravel doesn't support API versioning, **apiato** provide a very easy way to implement versioning for your API.


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

