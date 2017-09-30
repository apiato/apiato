---
title: "Languages"
category: "Optional Components"
order: 34
---

- [Definition](#definition)
- [Rules](#rules)
- [Folder Structure](#folder-structure)
- [Usage](#usage)


<a name="definition"></a>

### Definition

Languages are not real Components, they are just files that holds translations.

<a name="rules"></a>

### Rules

- Languages CAN be placed inside the Containers. However the default laravel `resources/lang` languages files are still loaded and can be used as well.

- All Translations are namespaced as the lower case of the Container name.

<a name="folder-structure"></a>

### Folder Structure

```
 - app
    - Containers
        - {container-name}
            - Resources
                - Languages
                   - en
                      - messages.php
                      - users.php
                   - ar
                      - messages.php
                      - users.php
```


<a name="usage"></a>

### Usage

Nothing much to show here, here's how you use translated strings:


```php
<?php

__('messages.welcome');

echo __('messages.welcome');

dd(__('messages.welcome'));
```


For more info about the localization checkout the [Localization]({{ site.baseurl }}{% link _docs/features/localization.md %}) page.
