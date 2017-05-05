---
title: "Supported Parameters"
category: "Features"
order: 10
---

Users often need to control the response data, thus the apiato supports some useful and common query parameters:



## Sorting & Ordering:

The `?sortedBy=` parameter is usually used with the `orderBy` parameter.

By default the `orderBy` sorts the data in **Ascending** order, if you want the data sorted in **Descending** order, you can add `&sortedBy=desc`.


```
?orderBy=id&sortedBy=asc
```

```
?orderBy=created_at&sortedBy=desc
?orderBy=name&sortedBy=asc
```

Order By Accepts:

- `asc` for Ascending.
- `desc` for Descending.



*(provided by the L5 Repository)*









## Searching:

The `?search=` parameter can be applied to any **`GET`** HTTP request.

For the search to work you need to add `fieldSearchable` to the Repository of the Model.


```php
<?php

protected $fieldSearchable = [
    'name',
    'email',
    // ...
];

// OR

protected $fieldSearchable = [
    'name'  => 'like',
    'email' => '=',
    // ...
];
```

	    
```
?search=John
?search=name:John
?search=name:John%20Doe
```

Notice should replace the space with `%20`.


> Space should be replaced with `%20` (search=keyword%20here).

#### Search any field for multiple keywords:

```
api.domain.dev/endpoint?search=first keyword;second keyword
```

#### Search in specific field:
```
api.domain.dev/endpoint?search=field:keyword here
```

#### Search in specific fields for multiple keywords: 
```
api.domain.dev/endpoint?search=field1:first field keyword;field2:second field keyword
```

#### Define query condition:

```
api.domain.dev/endpoint?search=field:keyword&searchFields=name:like
```

Checkout the Search Page for full implementation example.

*(provided by the L5 Repository)*

### Define search fields for search:

```
?search=name:John&email:john@main.com
?search=name:John;email:john@main.com
```

*(provided by the L5 Repository)*

See the [Search Parameter](http://apiato.io/C.features/search-parameter/) page, for how to set it up and control the searchability.

### Define the query condition for search:

```
?searchFields=name:like
?searchFields=email:=
?searchFields=name:like;email:=
?search=git&searchFields=url:like
```

*(provided by the L5 Repository)*








## Filtering:

The `?filter=` parameter can be applied to any HTTP request. And is used to controle the response size, by defining what data you want back in the response.

**Usage:**

Return only ID and Name from that Model, (everything else will be returned as `null`).

```
api.domain.dev/endpoint?filter=id;status
```

Example Response, including only id and status:

```json
{
  "data": [
    {
      "id": "0one37vjk49rp5ym",
      "status": "approved",
      "products": {
        "data": [
          {
            "id": "bmo7y84xpgeza06k",
            "status": "pending"
          },
          {
            "id": "o0wzxbg0q4k7jp9d",
            "status": "fulfilled"
          }
        ]
      },
      "recipients": {
        "data": [
          {
            "id": "r6lbekg8rv5ozyad"
          }
        ]
      },
      "store": {
        "data": {
          "id": "r6lbekg8rv5ozyad"
        }
      }
    }...
```



*(provided by the L5 Repository)*

Note that the transformer, which is used to output / format the data is also filtered. This means, that only the fields
to be filtered are present - all other fields are excluded. This also applies for all (!) relationships (i.e., includes) 
of the object.










## Pagination:

The `?page=` parameter can be applied to any **`GET`** HTTP request responsible for listing records (mainly for Paginated data).

**Usage:**

```
api.domain.dev/endpoint?page=200
```

*The pagination object is always returned in the **meta** when pagination is available on the endpoint.*

```shell
  "data": [...],
  "meta": {
    "pagination": {
      "total": 2000,
      "count": 30,
      "per_page": 30,
      "current_page": 22,
      "total_pages": 1111,
      "links": {
        "previous": "http://api.domain.dev/endpoint?page=21"
      }
    }
  }
```

*(provided by the Laravel Paginator)*







## Relationships:

Get an object with his relationships:

For this to work, your `Transformer` should have the relationships defined on it. *Check the [Transformers](http://apiato.io/D.components/transformers/) for more details.*

using `include` with comma `,` separator:

```
include=tags,user
```

The `?include=` parameter can be used with any endpoint, only if it supports it. 

How to use it: let's say there's a Driver object and Car object. And there's an endopint `/cars` that returns all the cars objects. 
The include allows getting the cars with their drivers `/cars?include=drivers`. 

However, for this parameter to work, the endpoint `/cars` should clearly define that it
accepts `driver` as relationship (in the **Available Relationships** section).

**Usage:**

```
api.domain.dev/endpoint?include=relationship
```




*(provided by the Fractal Transformer)*






## Caching skipping:

Note: You need to turn the Eloquent Query Caching ON for this feature to work. Checkout the Configuration Page "ELOQUENT_QUERY_CACHE".

To run a new query and force disabling the cache on certain endpoints, you can use this parameter

```
?skipCache=true
```

It's not recommended to keep skipping cache as it has bad impact on the performance.




*(provided by the L5 Repository)*












## Configuration

Most of thes parameters are provided by the L5 Repository and configurable from the `Ship/Configs/repository.php` file.
Some of them are built in house, or inherited from other packages such as Fractal.







#### See the Supported Parameters from the User Developer perspective:

1) Generate the Default API documentation

2) Visit the documentation URL

More details in the [API Docs Generator](http://apiato.io/C.features/api-docs-generator/) page.





### More

For more details on these parameters check out these links:

- [l5-repository](https://github.com/andersao/l5-repository#example-the-criteria)

- [Fractal Transformers](http://fractal.thephpleague.com/transformers/)
