---
title: "Code Generator"
category: "Features"
order: 101
---

## The feature is under development. (80% complete)

Check out the [Contribution Guide](http://apiato.io/B.general/contribution/) if you like to speed up the process.

Currently, the following commands for automatically generating code snippets are available:

* `php artisan apiato:action` : Creates a new `Action` within a container.
* `php artisan apiato:controller` : Creates an empty or CRUD `Controller` within a container for a given UI (e.g., API or WEB). Generated methods may vary based on the selected UI.
<!--
* `php artisan apiato:event` : Creates a new `Event` within a container -- may also generate the corresponding `EventHandler`. Do not forget to register the `Event` and / or the `EventHandler`.
* `php artisan apiato:eventhandler` : Creates a new `EventHandler` within a container. Do not forget to register the `Event` and / or the `EventHandler`.
-->
* `php artisan apiato:exception` : Creates a new `Exception` within a container.
* `php artisan apiato:model` : Creates a new `Model` within a container. Can automatically generate the corresponding `Repository`.
* `php artisan apiato:repository` : Creates a new `Repository` within a container. Must follow the naming conventions (e.g., UserRepository for the Model User)
* `php artisan apiato:request` : Creates a `Request` stub within a container and its defined user-interface.
* `php artisan apiato:route` : Creates a new `Route` within a container.
* `php artisan apiato:task` : Creates a new `Task` within a container.
* `php artisan apiato:transformer` : Creates an empty or full-blown `Transformer` within a container for a specified model. 

To get more information about respective generator, we refer to the `help` page of the command. To view this document,
simply call `php artisan help apiato:controller`.

The help page shows all options, which can be directly passed to the command.

Please note that **all** generators automatically inherit the options `--container` and `--file` (these are documented
as well in the help page). Furthermore, a generator may have specific options as well (e.g., the `--ui` (user-interface) 
to generate something for).

If you do not provide respective information via command line options, a wizard is displayed to guide you through 
the process of automatically generating code snippets.

For example, you can direclty call `php artisan apiato:controller --file=UserController` to directly specify the class
to be generated. The wizard, however, will ask you for the `--container` as well.
