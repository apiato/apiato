---
title: "Responses"
category: "Getting Started"
order: 5
---


* [Apiato Response](#Res-payload)
* [Default Apiato Responses Payload](#Def-Res-payload)
* [Change the default Response payload](#change-apiao-res-payload)
* [Resource Keys](#Resource-Keys)
* [Error Responses formats](#Error-Res-Format)
* [Building a Responses from the Controller](#build-res-from-con)


<br>

<a name="Res-payload"></a>
### Apiato Response

In Apiato you can define your own response payload or use one of the supported serializers.

Currently the supported serializers are (`ArraySerializer`, `DataArraySerializer` and `JsonApiSerializer`). As provided by [Fractal](http://fractal.thephpleague.com/transformers/).

By default Apiato uses `DataArraySerializer`. Below is an example of the response payload.
<a name="Def-Res-payload"></a>
### Default Apiato Responses Payload:

`DataArraySerializer` Responses Payloads:

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

**Includes:**

Informs the User about what relationships can be include in the response.
Example: `?include=tags,user`

For more details read the `Relationships` section in the [Query Parameters]({{ site.baseurl }}{% link _docs/features/query-parameters.md %}) page.

<a name="change-apiao-res-payload"></a>
### Change the default Response payload:

The default response format (specification) is the `DataArray` Fractal Serializer (`League\Fractal\Serializer\DataArraySerializer`). 

To change the default Fractal Serializer open the `.env` file and change the

```text
API_RESPONSE_SERIALIZER=League\Fractal\Serializer\DataArraySerializer
```

The Supported Serializers are (`ArraySerializer`, `DataArraySerializer` and `JsonApiSerializer`).

More details can be found at [Fractal](http://fractal.thephpleague.com/transformers/) and [Laravel Fractal Wrapper](https://github.com/spatie/laravel-fractal).

In case of returning JSON Data (`JsonApiSerializer`), you may wish to check some JSON response standards:

* [JSEND](https://labs.omniti.com/labs/jsend) (very basic)
* [JSON API](http://jsonapi.org/format/) (very popular and well documented)
* [HAL](http://stateless.co/hal_specification.html) (useful in case of hypermedia)


<a name="Resource-Keys"></a>
### Resource Keys

#### For JsonApiSerializer. 

The transformer allows appending a `ResourceKey` to the transformed resource.
You can set the `ResourceKey` in your response payload in 2 ways:

1. Manually set it via the respective parameter in the `$this->transform()` call. Note that this will only set the
`top level` resource key and does not affect the resource keys from `included` resources!
2. Specify it on the respective `Model`. By overriding the the $resourceKey, (`protected $resourceKey = 'FooBar';`). If no `$resourceKey` is defined at the `Model`, the `ShortClassName` is used as key. For example, the `ShortClassName` of
the `App\Containers\User\Models\User::class` is `User`.

#### For DataArraySerializer.

By default the `object` keyword is used as a resource key for each response, and it's set manually in each transformer, *to be automated later*.



<a name="Error-Res-Format"></a>
### Error Responses formats

Visit each feature, example the Authentication and there you will see how an unauthenticated response looks like, same for Authorization, Validation and so on.


<a name="build-res-from-con"></a>
## Building a Responses from the Controller:

Checkout the [Controller response builder helper functions]({{ site.baseurl }}{% link _docs/components/controllers.md %}).
