---
title: "Code Generator"
category: "Features"
order: 1
---

- [Introduction](#introduction)
- [Available Code Generator Commands](#available-code-generators)
- [Demo](#demo)
- [Custom Code Stubs](#custom-stubs)
- [Contributing](#contributing)
- [For AngularJS 2 Users](#for-angularjs-users)

<a name="introduction"></a>

## Introduction

Code Generators are a nice way to speed up development by creating boiler-plate code based on your inputs. You may
already be familiar with the Laravel code generators (`php artisan make:controller`). 

Apiato code generator works the same way. And in addition it can generate a full Container with fully working CRUD operations, including routes, requests, controller, Actions, Repositories, Models, Migrations, documentation.... and much more)


<a name="available-code-generators"></a>
## Available Code Generator Commands

To see the list of code generators type `php artisan`.


```
  apiato:generate:container        Create a Container for apiato from scratch
  apiato:generate:action           Create a Action file for a Container
  apiato:generate:configuration    Create a Configuration file for a Container
  apiato:generate:controller       Create a controller for a container
  apiato:generate:exception        Create a new Exception class
  apiato:generate:job              Create a new Job class
  apiato:generate:mail             Create a new Mail class
  apiato:generate:migration        Create an "empty" migration file for a Container
  apiato:generate:model            Create a new Model class
  apiato:generate:notification     Create a new Notification class
  apiato:generate:repository       Create a new Repository class
  apiato:generate:request          Create a new Request class
  apiato:generate:route            Create a new Route class
  apiato:generate:seeder           Create a new Seeder class
  apiato:generate:serviceprovider  Create a ServiceProvider for a Container
  apiato:generate:subaction        Create a new SubAction class
  apiato:generate:task             Create a Task file for a Container
  apiato:generate:transformer      Create a new Transformer class for a given Model

```

To get more info about each command, add `--help` to the command. Example: `php artisan apiato:generate:route --help`. The help page shows all options, which can be directly passed to the command.

If you do not provide respective information via the command line options, a wizard will be displayed to guide you through.

For example, you can directly call `php artisan apiato:generate:controller --file=UserController` to directly specify the class
to be generated. The wizard, however, will ask you for the `--container` as well.

Note that **all** generators automatically inherit the options `--container` and `--file` (these are documented
as well in the help page). Furthermore, a generator may have specific options as well (e.g., the `--ui` (user-interface)
to generate something for).






<a name="demo"></a>

## Demo

<a name="generating-a-route-endpoint-file"></a>

##### Generating a Route (endpoint) file:

![]({{ site.baseurl }}/images/documentation/generate-route-demo.png)

<a name="result"></a>

##### Result

![]({{ site.baseurl }}/images/documentation/generated-route-demo.png)






<a name="custom-stubs"></a>
# Custom Code Stubs (aka. Customizing the Generator)

If you don't like the automatically generated code (or would like to adapt it to your specific needs) you can do this quite easily.

The existing `Generators` allow to read `custom stubs` from the `app/Ship/Generators/CustomStubs` folder. The name of 
file needs to be the same as in `vendor/apiato/core/Generator/Stubs`.

Say, if you like to change the `config.stub`, simply copy the file to `app/Ship/Generators/CustomStubs/config.stub` and 
start adapting it to your needs. 

If you run the respective command (e.g., in this case `php artisan apiato:generate:configuration`) 
this would read your specific `config.stub` file instead the pre-defined one!



<a name="contributing"></a>
## Contributing

If you would like to add your own generators, please check out the [Contribution Guide]({{ site.baseurl }}{% link _docs/miscellaneous/contribution.md %}).



<a name="for-angularjs-users"></a>
## For AngularJS 2 Users

Checkout this awesome [CRUD Containers generator package](https://github.com/llstarscreamll/Crud) for Angular 2.4+.
