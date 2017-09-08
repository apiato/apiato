---
title: "Responses"
category: "Getting Started"
order: 6
---

* [Apiato Response](#Res-payload)
* [Default Apiato Responses Payload](#Def-Res-payload)
* [Change the default Response payload](#change-apiao-res-payload)
* [JsonApiSerializer Resource Key](#JsonApiSerializer-Resource-Key)
* [Error Responses formats](#Error-Res-Format)
* [Building a Responses from the Controller](#build-res-from-con)
  * [Building a Responses from the Controller](#build-res-from-controller)
<a name="Res-payload"></a>
###Apiato Response

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

The default response format (specification) is the `DataArray` Fractal Serializer.

To change the default Fractal Serializer open the `.env` file and change the

```text
API_RESPONSE_SERIALIZER=League\Fractal\Serializer\DataArraySerializer
```

The Supported Serializers are (`ArraySerializer`, `DataArraySerializer` and `JsonApiSerializer`).


More details can be found at [Fractal](http://fractal.thephpleague.com/transformers/) and [Laravel Fractal Wrapper](https://github.com/spatie/laravel-fractal).


<a name="JsonApiSerializer-Resource-Key"></a>
#### JsonApiSerializer Resource Key

The `JsonApiSerializer` allows appending a `ResourceKey` to the transformed resource.

There are a few ways to set this resource key:

1. You can manually set it via the respective parameter in the `$this->transform()` call. Note that this will only set the
`top level` resource key and does not affect the resource keys from `included` resources!
2. If you do not define the key in the `$this->transform` method, you can specify it on the respective `Model`. You can simply
override the the `protected $resourceKey = 'FooBar';` in order to specify the latter.
3. If no `$resourceKey` is defined at the `Model`, the `ShortClassName` is used as key. For example, the `ShortClassName` of
the `App\Containers\User\Models\User::class` is `User`.


**Note:** Apiato the `DataArraySerializer` and uses the `object` keyword as resource key for each response, and it's set manually in each transformer, to be automated later.

<a name="Error-Res-Format"></a>
### Error Responses formats

Visit each feature, example the Authentication and there you will see how an unauthenticated response looks like, same for Authorization, Validation and so on.

<a name="build-res-from-con"></a>

## Building a Responses from the Controller:
<a name="build-res-from-controller"></a>
### Building a Responses from the Controller:

Checkout the [Controller response builder helper functions]({{ site.baseurl }}{% link _docs/components/controllers.md %}).
