---
title: "Code Generator"
category: "Features"
order: 1
---

## Introduction

Code Generators are a nice way to speed up development by creating boiler-plate code based on your inputs. You may 
already know several code generators from Laravel, like `php artisan make:controller` or others.


## Demo

##### Generating a Route (endpoint) file:

![](https://s1.postimg.org/wob3ntyhr/Screen_Shot_2017-08-07_at_3.07.35_PM.png)

##### Result 
 
![](https://s1.postimg.org/owudp9ucf/Screen_Shot_2017-08-07_at_3.10.02_PM.png)

## Available Code Generators

To see list of code generators type `php artisan` and view the list of apiato commands.

To get more info about each command, add `--help` to the command. Example: `php artisan apiato:route --help`. The help page shows all options, which can be directly passed to the command.

If you do not provide respective information via the command line options, a wizard will be displayed to guide you through.

For example, you can directly call `php artisan apiato:controller --file=UserController` to directly specify the class
to be generated. The wizard, however, will ask you for the `--container` as well.

Note that **all** generators automatically inherit the options `--container` and `--file` (these are documented
as well in the help page). Furthermore, a generator may have specific options as well (e.g., the `--ui` (user-interface) 
to generate something for).


## Contributing

If you would like to add your own generators, please check out the [Contribution Guide]({{ site.baseurl }}{% link _docs/miscellaneous/contribution.md %}).

## For AngularJS 2 Users

Checkout this [CRUD Containers generator package](https://github.com/llstarscreamll/Crud) for Angular 2.4+.
 
 
