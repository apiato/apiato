---
title: "Configs"
category: "Optional Components"
order: 31
---

### Definition

Configs are files that container configurations. For more details about them check this [doc](https://laravel.com/docs/5.3/configuration).

## Principles

- Your custom config files and the third party packages config files, should be placed in the Container, unless it's too generic then it can be placed on the Ship Layer.

- Container can have as many config files as it needs.

### Rules

- When publishing a third party package config file move it manually to its container or to the Ship Features Config folder in case it is generic.

- Framework config files (provided by laravel) lives at the default config directory on the root of the project.

- You SHOULD not add any config file to the `app/config` directory.

### Folder Structure

```
 - App
    - Containers
        - {container-name}
            - Configs
                - conf1.php
                - ...
    - Ship
        - Features
            - Configs
                - apiato.php
                - ...
- config
    - app.php
    - ...
```

### Code Samples

**Example simple Config file** 

```php
<?php

return [

    'containers' => [
        /*
        |--------------------------------------------------------------------------
        | Default Namespace
        |--------------------------------------------------------------------------
        */
        'namespace'       => 'App',

        // some other config params here...
    ],
```
