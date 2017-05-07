---
title: "Code Generator"
category: "Features"
order: 101
---

## Introduction

Code Generators are a nice way to speed up development by creating boiler-plate code based on your inputs. You may 
already know several code generators from Laravel, like `php artisan make:controller` or others.

In order to provide an easy to use approach for generating all kinds of components within a container (i.e., be sure to 
read the docs about the [Porto architecture](http://apiato.io/B.general/porto-sap/)!), apiato provides some neat 
generators specifically tailored for your needs.

However, as some of them may be _complex_ to use, apiato offers some kind of **wizard based generators**, guiding you
through the process of automatically generating code.

## Available Code Generators

Currently, the following commands for automatically generating code snippets are available:

* `php artisan apiato:action` : Creates a new `Action` within a container.
* `php artisan apiato:controller` : Creates an empty or CRUD `Controller` within a container for a given UI (e.g., API or WEB). Generated methods may vary based on the selected UI.
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

## Contributing

If you would like to add your own generators, please check out the [Contribution Guide](http://apiato.io/B.general/contribution/).

## For AngularJS 2 Users

Checkout this [CRUD Containers generator package](https://github.com/llstarscreamll/Crud) for Angular 2.4+.
 
 
