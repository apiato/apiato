---
title: "Events"
category: "Components"
order: 22
---

### Definition

Events provide a simple observer implementation, allowing you to subscribe and listen for events in your application. 

## Principles

- A Container MAY have more than one Events.

- Events can be fired from other Containers.

### Rules

- All Events MUST extend from `App\Ship\Parents\Events\Event`.

- Every Event MUST have an Event Handler.

- All Events MUST be registered in an `EventsServiceProvider` inside the Container.

- Events can be fired from Actions and Services.

### Folder Structure

WILL BE UPDATED

```
 - app
    - Containers
        - {container-name}
            - Events
                - Events
                        - UserCreatedEvent.php
                            - ...
                    - Handlers
                        - UserCreatedEventHandler.php
                            - ...
            - Providers
                    - EventsServiceProvider.php
                    - UserServiceProvider.php
                - ...

```

### Code Samples

**User Created Event:** 

```php
<?php

namespace App\Containers\User\Events\Events;

use App\Ship\Parents\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserCreatedEvent extends Event
{

    use SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function broadcastOn()
    {
        return [];
    }
}
```


**User Created Event Handler:** 


```php
<?php

namespace App\Containers\User\Events\Handlers;

use App\Containers\Store\Services\CreateStoreService;
use App\Containers\User\Events\Events\UserCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreatedEventHandler implements ShouldQueue
{
    private $createStoreService;

    public function __construct(
        CreateStoreService $createStoreService
    ) {
        $this->createStoreService = $createStoreService;
    }

    public function handle(UserCreatedEvent $event)
    {
        // Do anything :)

        // Example:
        //    Create default store for the new user
        $this->createStoreService->run($event->user);

    }
}

```

	 
**Note**: $event->user gives access to the $user input in the UserCreatedEvent constructor

**User Events Service Provider:**

```php
<?php

namespace App\Containers\User\Providers;

use App\Containers\User\Events\Events\UserCreatedEvent;
use App\Containers\User\Events\Handlers\UserCreatedEventHandler;
use App\Containers\User\Providers\EventsServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;

class EventsServiceProvider extends EventsServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserCreatedEvent::class => [
            UserCreatedEventHandler::class,
        ],
    ];

    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
	 
```


**Note:** this MUST be registered in the Main Container Service Provider (in that case in the `UserServiceProvider`).

**Usage: Fire the Event:** 

```php
<?php

// ..

public function __construct(Dispatcher $eventsDispatcher)
{
    $this->eventsDispatcher = $eventsDispatcher;
}

public function run()
{
    // Do anything.. then:

    // Fire a User Created Event
    $this->eventsDispatcher->fire(New UserCreatedEvent($user));
}

// .. 
```


For more information about the `Events` read [this](https://laravel.com/docs/events).
