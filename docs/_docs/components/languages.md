---
title: "Languages"
category: "Optional Components"
order: 34
---

### Definition

Languages are not real Components, they are just files that holds translations.

### Rules

- Languages CAN be placed inside the Containers. However the default laravel `resources/lang` languages files are still loaded and can be used as well.

- All Translations are namespaced as the lower case of the Container name.

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
	 

### Usage

Nothing much to show here, here's how you use translated string:


```php
<?php

__('messages.welcome');

echo __('messages.welcome');

dd(__('messages.welcome')); 
```


For More info about the localization checkout the [Localization]({{ site.baseurl }}{% link _docs/features/localization.md %}) page.
