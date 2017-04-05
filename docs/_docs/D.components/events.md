---
title: "Events"
category: "Components"
order: 22
---

### Definition

Events provide a simple observer implementation, allowing you to subscribe and listen for events in your application. 



## Principles

- Every Event MUST have an Event Handler.

- A Container MAY have more than one Events (and their Handlers).

- Events handlers SHOULD NOT contain business logic, they should call Actions to perform the business logic.

- Events handlers SHOULD not call Tasks directly.

- Events can be fired from Actions and/or Tasks (firing them from the same Component in every Container is recommended).

- Events can be fired from other Containers as well.


### Rules

- All Events MUST extend from `App\Ship\Parents\Events\Event`.

- All Events MUST be registered in an `EventsServiceProvider` inside the Container (if not created, you need to create one).


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

use App\Containers\Store\Actions\CreateStoreAction;
use App\Containers\User\Events\Events\UserCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreatedEventHandler implements ShouldQueue
{
    private $createStoreAction;

    public function __construct(
        CreateStoreAction $createStoreAction
    ) {
        $this->createStoreAction = $createStoreAction;
    }

    public function handle(UserCreatedEvent $event)
    {
        // ..

        // Create default store for the new user
        $this->createStoreAction->run($event->user);

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
use App\Ship\Parents\Providers\EventsProvider;

class EventsServiceProvider extends EventsProvider
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

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

	 
```


**Note:** The Container Events Service Provider MUST be registered in the Main Container Service Provider.

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

     event(new UserCreatedEvent($user));
}

// .. 
```


For more information about the `Events` and how to use them, visit [Laravel Events](https://laravel.com/docs/events).
