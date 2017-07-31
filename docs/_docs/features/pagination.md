---
title: "Pagination"
category: "Features"
order: 23
---

For pagination apiato uses the [L5 Repository Package](https://packagist.org/packages/prettus/l5-repository) and the 
pagination gets applied whenever you use the `paginate` function on any model repository 
(example: `$stores = $this->storeRepository->paginate();`).

## Change the the default pagination limit

Open the `.env` file and set a number for `PAGINATION_LIMIT_DEFAULT`:

```env
PAGINATION_LIMIT_DEFAULT=10
```

This is used in the `config/repository.php` which is the config file of the **L5 Repository** Package.

## Limit: 

The `?limit=` parameter can be applied to define, how many results should be returned on one page (see also `Pagination`!).

**Usage:**

```
api.domain.dev/endpoint?limit=100
```

This would return 100 resources within one page of the result. Of course, the `limit` and `page` query parameter can be 
combined in order to get the next 100 resources:

```
api.domain.dev/endpoint?limit=100&page=2
```

In order to allow clients to request all data that matches their criteria (e.g., search-criteria) and disable pagination, 
you can manually override the `$allowDisablePagination` property in your specific `Repository` class. A requester can then
get all data (with no pagination applied) by requesting `api.domain.dev/endpoint?limit=0`. This will return all matching
entities.


## Skip the Pagination Limit:

You can allow developers to skip the pagination limit as follow:

First you need to enable that feature from the server by setting `PAGINATION_SKIP` to `true` (`PAGINATION_SKIP=true`).

Second inform the developers (users) to pass `?limit=0` with the request they wish to get all it's data unpaginated.  
