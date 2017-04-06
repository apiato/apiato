---
title: "Responses Format"
category: "General"
order: 2
---

#Responses Payloads:

**Specification: The default format has the following skeleton:**

```json
{
  "data": [
    {
      "id": 100,
      ...
      "relation 1": {
        "data": [
          {
            "id": 11,
			  ...
          }
        ]
      },
      "relation 2": {
        "data": {
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
  }
}
```

**Paginated response:**

When data is paginated the response payload will contain a `meta` description about the pagination.

```json
  "meta": {
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
```

### Error Responses formats

Visit each feature, example the Authentication and there you will see how unauthenticate response looks like, same for Authorization, Validation and so on.


### Change the Response payload format:

The default response format (specification) is the `DataArray` Fractal Serializer.

To change the default Fractal Serializer open the `.env` file and change the

```text
API_RESPONSE_SERIALIZER=League\Fractal\Serializer\DataArraySerializer
```

The Supported Serializers are (`ArraySerializer`, `DataArraySerializer` and `JsonApiSerializer`).


More details at [Fractal](http://fractal.thephpleague.com/transformers/) and [Laravel Fractal Wrapper](https://github.com/spatie/laravel-fractal).
