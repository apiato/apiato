---
title: "Events"
category: "Optional Components"
order: 35
---

- [Definition](#definition)
- [Rules](#rules)
- [Usage](#usage)
- [Dispatch Events](#dispatch-events)
- [Queueing](#Queueing)

<a name="definition"></a>

### Definition

Events provides a simple observer implementation, allowing you to subscribe and listen for various events that occur in your application. More details [here](https://laravel.com/docs/events).

<a name="rules"></a>

### Rules

- Events classes CAN be placed inside the Containers in Events folders or on the Ship for the general Events.
- All Events MUST extend from `App\Ship\Parents\Events\Event`.

<a name="usage"></a>

### Usage

In laravel you can create and register events in multiple way. The recommended way by Apiato is the following:

Create an Event that handles itself. (This will remove the need for the `EventsServiceProvider` which map each Event to its handler).
**But if you prefer using that method you can extend `Apiato\Core\Abstracts\Providers\EventsProvider`.**

Event Class Example:

```php
<?php

namespace App\Containers\User\Events;

use App\Containers\User\Models\User;
use App\Ship\Parents\Events\Event;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UserRegisteredEvent extends Event implements ShouldQueue
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        Log::info('New User registration. ID = ' . $this->user->getHashedKey() . ' | Email = ' . $this->user->email . '.');

        // ...
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
```  


<a name="dispatch-events"></a>

### Dispatch Events

You can dispatch an Event from anywhere you want (ideally from Actions and Tasks).

Example: Dispatching the Event class from the example above
```php
<?php

// using helper function
event(New UserEmailChangedEvent($user));

// manually
\App::make(\Illuminate\Contracts\Bus\Dispatcher\Dispatcher::class)->dispatch(New UserEmailChangedEvent($user));
```

<a name="Queueing"></a>
## Queueing an Event

Events can implement `Illuminate\Contracts\Queue\ShouldQueue` to be queued. 
  
