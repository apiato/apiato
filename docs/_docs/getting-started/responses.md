---
title: "Responses"
category: "Getting Started"
order: 5
---

### Responses Payloads:

**Specification: The default format has the following skeleton:**

```json
{
  "data": [
    {
      "id": 100,
      ...
      "relation 1": {
        "data": [ // multiple data
          {
            "id": 11,
			  ...
          }
        ]
      },
      "relation 2": {
        "data": { // single data
          "id": 22,
          ...
          }
        }
      }
    },
    ...
  ],
  "meta": {
    "pagination": {
      "total": 999,
      "count": 999,
      "per_page": 999,
      "current_page": 999,
      "total_pages": 999,
      "links": {
        "next": "http://api.apiato.dev/v1/accounts?page=999"
      }
    }
  },
  "include": [ // what can be included
    "xxx",
    "yyy"
  ],
  "custom": []
}
```

**Paginated response:**

When data is paginated the response payload will contain a `meta` description about the pagination.

```json
{
  "meta" : {
    "pagination": {
      "total": 18,
      "count": 10,
      "per_page": 10,
      "current_page": 1,
      "total_pages": 2,
      "links": {
        "next": "http://api.apiato.dev/v1/accounts?page=2"
      }
    }
  }
}
```

**Includes:**

Informs the User about what relationships can be include in the response.
Example: `?include=tags,user`

For more details read the `Relationships` section in the [Query Parameters](http://apiato.io/C.features/query-parameters/) page.


### Error Responses formats

Visit each feature, example the Authentication and there you will see how an unauthenticated response looks like, same for Authorization, Validation and so on.


### Change the Response payload format:

The default response format (specification) is the `DataArray` Fractal Serializer.

To change the default Fractal Serializer open the `.env` file and change the

```text
API_RESPONSE_SERIALIZER=League\Fractal\Serializer\DataArraySerializer
```

The Supported Serializers are (`ArraySerializer`, `DataArraySerializer` and `JsonApiSerializer`).


More details at [Fractal](http://fractal.thephpleague.com/transformers/) and [Laravel Fractal Wrapper](https://github.com/spatie/laravel-fractal).


#Building a Responses from the Controller:

Array Response:

```php
        $xyz = ['xx', 'yy'];

        return $this->json(['something' => $xyz]);
```

Array Data Object:

```php
        return $this->transform($order, OrderTransformer::class); // Order can be the Order object or/and Collection of Orders objects.
```

Override some includes:

```php
        return $this->transform($order, OrderTransformer::class, ['recipients', 'store']);
```

Visit the `app/Ship/Engine/Traits/ResponseTrait.php` file, for more available response features (such as `withMeta`, `accepted`, `deleted`,...).
