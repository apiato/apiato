---
title: "Configs"
category: "Optional Components"
order: 31
---

* [Definition](#definition)
- [Principles](#principles)
* [Rules](#rules)
* [Folder Structure](#folder-structure)
* [Code Samples](#code-samples)


<a name="definition"></a>
### Definition

Configs are files that container configurations. For more details about them check this [doc](https://laravel.com/docs/5.3/configuration).

In each Apiato container, there are two types of config files: 
- the container specific config file (a config file that contains the container specific configurations).
- the container third party packages config files (a config file that belongs to a third party package, required by the composer file of the container).   

<a name="principles"></a>
## Principles

- Your custom config files and the third party packages config files, should be placed in the Container, unless it's too generic then it can be placed on the Ship Layer.
- Container can have as many config files as it needs.

<a name="rules"></a>
### Rules

- When publishing a third party package config file move it manually to its container or to the Ship Features Config folder in case it is generic.
- Framework config files (provided by laravel) lives at the default config directory on the root of the project.
- You SHOULD not add any config file to the `app/config` directory. 
- The container specific config file, MUST have the same name of the container in lower letters and postfixed with `-container`, to prevent conflicts between third party packages and container specific packages.

<a name="folder-structure"></a>
### Folder Structure

```
 - App
    - Containers
        - {container-name}
            - Configs
                - config1-container.php
                - package-config-file1.php
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

<a name="code-samples"></a>
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
