---
title: "Commands"
category: "Optional Components"
order: 32
---

### Definition

Commands are the console commands, it's a way to execute some code from the CLI.

Commands could be Closure based or Classes. For more details refer to this [link](https://laravel.com/docs/artisan).

## Principles

- Containers MAY or MAY NOT have one or more Commands.

- Every should be calling Actions. And should not container any business logic.

### Rules

- All Command MUST extend from `App\Ship\Parents\Commands\ConsoleCommand`.

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

