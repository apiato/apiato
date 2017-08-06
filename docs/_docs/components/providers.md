---
title: "Providers"
category: "Optional Components"
order: 13
---

### Definition

Providers (are short names for Service Providers).

Providers are the central place of configuring and bootstrapping a Container.

They are the place where you register things like container bindings, event listeners, middleware, routes, other providers, aliases... to the framework service container.

## Principles

- There are 2 types of Providers in a Container, the **Main Provider** and the **Additional (Job Specific) Providers** (EventsProvider, BroadcastsProvider, AuthProvider, MiddlewareProvider, RoutesProvider).

- A Container MAY have one or many Providers and MAY have no Provider at all. 

- A Container CAN have only a single Main Provider.

- The Main Provider is where all the Job Specific Providers get registered.

- Third party packages Providers MUST be registered inside the Container Main service provider.  (Same applies to Aliases).

- Providers CAN be registered on the Ship Main Provider, if they are general or are intended to be used by many containers. (Same applies to Aliases).

### Rules

- The Main Provider will be auto registered by the Ship Engine, so no need to register it manually anywhere.

- All Main Providers MUST extend from `App\Ship\Parents\Providers\MainProvider`.

- All other types of Providers (EventsProvider, BroadcastsProvider, AuthProvider, MiddlewareProvider, RoutesProvider) must extend from their parent providers `Ship/Parents/Providers/*`.

- The Main Provider MUST be named `MainServiceProvider` in every container.

- Only the Ship Main Provider (`App\Ship\Engine\Providers\PortoServiceProvider`) SHOULD be registered in the framework "Laravel" (`config/app.php`).

### Folder Structure

**Example: User Container `Service Providers`** 

```
 - app
    - Containers
        - User
            - Providers
                - UserServiceProvider.php
                - EventsServiceProvider.php
                - ...
```
            
	                
In this example above only the `AuthServiceProvider` and `EventsServiceProvider` needs to be registered in `UserServiceProvider`. While the `UserServiceProvider` will get automatically registered (since it's named based on his Container name).

### Code Samples

**Main Service Provider Example:** 


```php
<?php

namespace App\Containers\Excel\Providers;

use App\Ship\Parents\Providers\MainProvider;
use Maatwebsite\Excel\ExcelServiceProvider;
use Maatwebsite\Excel\Facades\Excel;

class MainServiceProvider extends MainProvider
{

    /**
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [
        // ...			
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [
        // ...
    ];

    /**
     * Register anything in the container.
     */
    public function register()
    {
        parent::register();

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
```

	 
**Note**: when defining `register()` or `boot()` function in your Main provider "only" you must call the parent functions (`parent::register()`, `parent::boot()`) from your extended function.

### Register Service Providers:

### Container's Main Service Provider

No need to register the Main `Service Provider` anywhere, it will be automatically registered by the `Ship`, and it is responsible for registering all the Container Additional (Job Specific) Providers.

### Container's Additional Service Providers

You MAY add as many Additional `Service Providers` as you want in a `Container`. However, in order to get them loaded in the framework you MUST register them all in the Main `Service Provider` as follow:


```php
<?php

private $containerServiceProviders = [
    AuthServiceProvider::class,
    EventsServiceProvider::class,
    // ...
];
], 
```

> Same rule applies to **Aliases**.

### Third party packages Service Providers

If a package requires registering its service provider in the `config/app.php`, you can register that service provider in the Main container as well.

### Laravel Service Providers

By default Laravel provides some service providers in its `app/providers` directory. 
In apiato those providers have been renamed and moved to the Ship Layer `app/Ship/Parents/Providers/*`:

- AppServiceProvider
- RouteServiceProvider
- AuthServiceProvider
- BroadcastServiceProvider
- EventsServiceProvider
