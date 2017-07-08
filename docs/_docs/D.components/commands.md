---
title: "Commands"
category: "Components"
order: 32
---

### Definition

Commands are the console commands, it's a way to execute some code from the CLI.

Commands could be Closure based or Classes. For more details refer to this [link](https://laravel.com/docs/artisan).

## Principles

- Containers MAY or MAY NOT have one or more Commands.

- Every Command should be calling Actions. And should not contain any business logic.

### Rules

- All Commands MUST extend from `App\Ship\Parents\Commands\ConsoleCommand`.

### Folder Structure

```
 - app
    - Containers
        - {container-name}
            - UI
                - CLI
                    - Commands
                        - SayHello.php
                        - ...
```

### Code Samples

**Example: a simple Command** 

```php
<?php

namespace App\Containers\Welcome\UI\CLI\Commands;

use App\Ship\Parents\Commands\ConsoleCommand;

class SayWelcome extends ConsoleCommand
{

    protected $signature = 'say:welcome';

    protected $description = 'Just Saying Welcome.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        dump('Welcome to apiato :)');
    }
}

```

**Usage from CLI (Terminal):** 

```shell
php artisan say:welcome 
```


### Ship: Generic Commands (for the entire App)

If you want to create a generic Command for the entire Application, 
you can place that command class in the **Ship** layer inside the _Commands_ `app/Ship/Commands/*`. 
And your Command will auto-magically get registered by the `app/Ship/Engine/Loaders/ConsolesLoaderTrait.php`.
 
However if you wish to place your command anywhere else in the `Ship` layer you can register you command manually 
as you would with Laravel by adding your command to 
the `app/Ship/Engine/Kernels/ShipConsoleKernel.php` class in the `$commands` property.



##### The Code Generator Commands

The Code Generator Commands `app/Ship/Generator/Commands` Do not follow the convention mentioned above. 
Since they live in the Generator folder as portable container for the Ship those commands are registered by their 
 `app/Ship/Generator/GeneratorsServiceProvider.php`.
 
 For more details checkout the [Contributing to the Code Generator](http://apiato.io/B.general/contribution/) steps. 
