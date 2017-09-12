---
title: "Commands"
category: "Optional Components"
order: 32
---

* [Definition](#definition)
* [Principles](#principles)
* [Rules](#rules)
* [Folder Structure](#folder-structure)
* [Code Samples](#code-samples)

<a name="definition"></a>

### Definition

Commands are the console commands, it's a way to execute some code from the CLI.

Commands could be Closure based or Classes. For more details refer to this [link](https://laravel.com/docs/artisan).

<a name="principles"></a>

## Principles

- Containers MAY or MAY NOT have one or more Commands.

- Every Command SHOULD call an Action to perform its job. And should not container any business logic.

- Ship may contain Application general Commands.


<a name="rules"></a>

### Rules

- All Commands MUST extend from `App\Ship\Parents\Commands\ConsoleCommand`.

<a name="folder-structure"></a>

### Folder Structure

```
 - app
    - Containers
        - {container-name}
            - UI
                - CLI
                    - Commands
                        - SayHelloCommand.php
                        - ...
    - Ship
        - Commands
            - GeneralCommand.php
            - ...
```

<a name="code-samples"></a>

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
