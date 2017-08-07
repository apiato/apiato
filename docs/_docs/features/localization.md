---
title: "Localization"
category: "Features"
order: 15
---

The Localization is provided by the Localization Container.

## Select response language

You can choose the language of the response by adding the header `Content-Language` to the request.

By default the `Content-Language` is set to `en`. 

You can change the default language from the `config/app.php` `locale`.

When the `Content-Language` header is missed the default will always be used. 

And the response will also contain the default language in the `Content-Language` header.

## Support new language

1. All supported languages must be added to the `supported_languages` in `app/Containers/Localization/Configs/localization.php` to prevent users from requesting unsupported languages, as follow:

```php
<?php

    'supported_languages' => [
        'en' => 'English',
        'ar' => 'Arabic',
        'fr' => 'French',
        'ru' => 'Russian',
    ],
```

2. Create your languages files:

Languages file can be placed in any container, not only the Localization Container. Refer to the [Localization]({{ site.baseurl }}{% link _docs/features/localization.md %}) page for more info.

Example languages files are included in the Localization Container at `app/Containers/Localization/Resources/Languages`.

## Namespaces

By default all the Container translation files are namespaced to the Container name.

**Example:**

If a Container named `Store` has `en` translation file called `notifications` that contains translation for  `welcome` as "Welcome to our store :)". You can access this translation as follow `trans('store::notifications.welcome')`. If you remove the namespace (which is the lowercase of the container name) and try to access it like this `trans('notifications.welcome')` it will not find your translation and will print `notifications.welcome` only.

## Disable Localization

You will need to remove the Localization Middleware, by simply going to `app/Containers/Localization/Providers/MainServiceProvider.php` and removing the `MiddlewareServiceProvider` from the `$serviceProviders` property.

## Tests

To change the default language in your tests requests. You can set the `env` language in the `phpunit.xml` file.
