---
title: "Supported Parameters"
category: "Features"
order: 10
---

Users often need to control the data request, thus the apiato support out of the box the most useful and common parameters:

## Sorting & Ordering:

```

?orderBy=id&sortedBy=asc

```

```

?orderBy=created_at&sortedBy=desc

```

*(provided by the L5 Repository)*

## Searching:

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

Checkout the Search Page for full implementation example.

*(provided by the L5 Repository)*

### Define search fields for search:

```
?search=name:John&email:john@main.com

?search=name:John;email:john@main.com

```

*(provided by the L5 Repository)*

See the [Search Parameter](doc:search-parameter) page, for how to set it up and control the searchability.

### Define the query condition for search:

```
?searchFields=name:like

?searchFields=email:=

?searchFields=name:like;email:=

?search=git&searchFields=url:like

```

*(provided by the L5 Repository)*

## Filtering:

Select your columns:

```

?search=git&filter=id;url;note

```

*(provided by the L5 Repository)*

## Paging:

```
?page=22

```

*(provided by the Laravel Paginator)*

## Relationships:

Get an object with his relationships:

For this to work, your `Transformer` should have the relationships defined on it. *Check the [Transformers](doc:transformers) for more details.*

using `include` with comma `,` separator:

```
include=tags,user

```

*(provided by the Fractal Transformer)*

Similar to `include=` is the `with=` parameter (provided by the L5 Repository). There's no need to use it since it's almost the same as `include=` so we'll use that instead.

## Caching skipping:

Note: You need to turn the Eloquent Query Caching ON for this feature to work. Checkout the Configuration Page "ELOQUENT_QUERY_CACHE".

To run a new query and force disabling the cache on certain endpoints, you can use this parameter

```
?skipCache=true

```

It's not recommended to keep skipping cache as it has bad impact on the performance.

*(provided by the L5 Repository)*

## Where to apply these parameters?

You can include these parameters on almost every `[GET]` endpoint)

## Configuration

All the parameters that are provided by the L5 Repository are configurable from the `Ship/Features/Configs/repository.php` file.

#### See the Supported Parameters from the User Developer perspective:


1) Generate the Default API documentation

2) Visit the documentation URL

More details in the [API Docs Generator](doc:api-docs-generator) page.

### More

For more details on these parameters check out these links:

- [l5-repository](https://github.com/andersao/l5-repository#example-the-criteria)

- [Fractal Transformers](http://fractal.thephpleague.com/transformers/)
