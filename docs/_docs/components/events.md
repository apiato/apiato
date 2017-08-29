---
title: "Events"
category: "Optional Components"
order: 35
---

### Definition

Events provides a simple observer implementation, allowing you to subscribe and listen for various events that occur in your application. More details [here](https://laravel.com/docs/events).

### Rules

- Events classes CAN be placed inside the Containers in Events folders or on the Ship for the general Events.
- All Events MUST extend from `App\Ship\Parents\Events\Event`.

### Usage

In laravel you can create and register events in multiple way. The recommended way by Apiato is the following:

Create an Event that handles itself. (This will remove the need for the `EventsServiceProvider` which map each Event to its handler). 
**But if you prefer using that method you can extend `Apiato\Core\Abstracts\Providers\EventsProvider`.**

Event Class Example: 

```php
<?php

use App\Ship\Parents\Events\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UserEmailChangedEvent extends Event implements ShouldQueue
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        Log::info('Queue Started: (User Email Changed Event) for [' . $this->user->getHashedKey() . '] new email ' . $this->user->email);

        // ...
    }
}
```  

Events can implement `ShouldQueue` incase it needs to be queued and other interfaces as well. Refer to the [Laravel Events](https://laravel.com/docs/events) documentation for more details.  

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
