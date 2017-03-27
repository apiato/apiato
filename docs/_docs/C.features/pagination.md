---
title: "Pagination"
category: "Features"
order: 23
---

For pagination apiato uses the [L5 Repository Package](https://packagist.org/packages/prettus/l5-repository) and the pagination gets applyed whenever you use the `paginate` function on any model repository (example: `$stores = $this->storeRepository->paginate();`).

## Change the the default pagination limit

Open the `.env` file and set a number for `PAGINATION_LIMIT`:

```env

PAGINATION_LIMIT=10

```

This is used in the `config/repository.php` which is the config file of the **L5 Repository** Package.
