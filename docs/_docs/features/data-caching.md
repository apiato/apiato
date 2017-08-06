---
title: "Data Caching"
category: "Features"
order: 22
---

## Enable / Disable Eloquent Query Caching

By default caching is disabled.

To enable it, go to `config/repository.php` config file and set `cache` > `enabled  => true`, or set it from the `.env` file using `ELOQUENT_QUERY_CACHE`.

More details can be found [here](https://github.com/andersao/l5-repository#cache-config). 

Users can skip the query caching and request new data by passing specific parameter to the Endpoint. Checkout the Query parameters page.

## Change different caching settings

You can use different cache setting for each repository

To set cache settings on each repository, first the caching must be enabled, second you need to set some properties on the repository class to override the default values.

For an example look at the `app/Containers/Countries/Data/Repositories/CountryRepository.php` class. For more details about all the properties refer to [the L5 repository package documentation](https://github.com/andersao/l5-repository#cache-config).

Note: you don't need to use the `CacheableRepository` trait or implement the `CacheableInterface` since they both exist on the Abstract repository class (`App\Ship\Parents\Repositories\Repository`).
