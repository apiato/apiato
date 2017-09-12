---
title: "Commands"
category: "Optional Components"
order: 36
---

* [Definition](#definition)
* [Principles](#principles)
* [Rules](#rules)
* [Folder Structure](#folder-structure)
* [Code Samples](#code-samples)
* [Select Channels](#Select-Channels)

<a name="definition"></a>

### Definition

Notifications allows you to inform the user about a state changes in your application.  

The Laravel notifications supports sending notifications across a variety channels (mail, SMS, Slack, Database...). 

When using the Database channel the notifications will be stored in a database to be displayed in your client interface.

For more details refer to this [link](https://laravel.com/docs/notifications).

<a name="principles"></a>

## Principles

- Containers MAY or MAY NOT have one or more Notification.

- Ship may contain Application general Notifications.


<a name="rules"></a>

### Rules

- All Notifications MUST extend from `App\Ship\Parents\Notifications\Notification`.

<a name="folder-structure"></a>

### Folder Structure

```
 - app
    - Containers
        - {container-name}
            - Notifications
                - UserRegisteredNotification.php
                - ...
    - Ship
        - Notifications
            - SystemFailureNotification.php
            - ...
```

<a name="code-samples"></a>

### Code Samples

**Example: a simple Notification**

```php
<?php

namespace App\Containers\User\Notifications;

use App\Containers\User\Models\User;
use App\Ship\Parents\Notifications\Notification;
use Illuminate\Bus\Queueable;

class UserDiedNotification extends Notification
{

    use Queueable;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function toArray($notifiable)
    {
        return [
            // ...
        ];
    }

}
```

**Usage from an Action:**

Notifications can be sent from Actions or Tasks.

```php
Notification::send($user, new UserDiedNotification($user));
```

<a name="Select-Channels"></a>
## Select Channels

To select a notification channel, apiato have the `app/Ship/Configs/notification.php` config file where you can define the array of supported channels.
You can override the **via** function `public function via($notifiable)`, of you want to use different channel for some Notifications. 
