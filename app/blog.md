# Apiato v10 is finally here!

### Changelog:
* Updated to Laravel 8.0
* Min PHP version is now 7.4
* Laravel auto discovery is now enabled
* Now using Composer v2
* Removed Swagger doc generator
* Removed `Transporter` feature
* Concept of "Section" from [Porto](https://github.com/Mahmoudz/Porto) pattern is now implemented
* Extracted Apiato Core into its own [repository](https://github.com/apiato/core)
* Extracted [Payment](), [Stripe](), [SocialAuth]() & [Settings]() Containers into their own repo which are installable using Containers Installer
* You can now have a `Helpers` folder in your Container and all `.php` helper files will be loaded automatically by Apiato. [read more]().
* All route definitions are updated to use Laravel new style: `Route::get('user/profile', [Controller::class, 'getAuthenticatedUser'])`. You can still use the old style of course.
* Default admin panel has been removed: `admin.apiato.test`
* We are now using Laravel error handling which means all Laravel related features are now at your disposal.
* You can now set default values while sanitizing data from request
```php
        $sanitizedData = $data->sanitizeInput([
            'name' => 'Mohammad', // if name is not provided then default value will be set
            'product.company.address' => 'Somewhere in the world', // dot notation is also supported
            'email',
            'password'
        ]);
```
* Documentations are moved to `apiato.test/docs` & `apiato.test/docs/private`. Private docs are now protected. [read more]()

