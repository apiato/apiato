---
title: "Contribution"
category: "General"
order: 4
---



## How to contribute to the Components Generator:

 Path: `app/Ship/Generator`

All Commands live in `app/Ship/Generator/Commands`.
Each component command, "Except the Containers Generator" must extend from the `app/Ship/Generator/GeneratorCommand.php`.

This abstract class does most of the work for you. So how to add new component.

1. Add create new command by copy pasting any of the demo commands provided. The `app/Ship/Generator/Commands/RouteGenerator.php` is great example.

What's inside?

- Class Properties: should be easy to understand.
  - The `$nameStructure` will help us rename complex files names like the Route component, based on user inputs or other facts.
  - The `$inputs` should be ordered and always start with container name `php artisan apiato:controller container-name component-file-name other params`.

- `fireMe` function: will be called from the abstract class. When firing an event the first function gets called is the `fire` but this function is on the abstract class. so the abstract will do some stuff for you and then call your `fireMe` function inside your component.
  here's where you have to collect user inputs and pass them to the `_callRenderStub` (don't call the render directly instead use this function, it will do some stuff and call your function at the end passing what's needed).

- `renderStub` function: will take all the params passed to `_callRenderStub` in the same order, so you can simply pass your data to the stub file and will be replaced in the right place.

2. Let's create the stub now in `app/Ship/Generator/Stubs`, copy any real component code and build the stub out of it. That should be easy.

3. Finally, let's go back to our component and add set the `parseFilename` to replace the inputs with the name structure property. You need to call this function manually `$this->getAndAssignInputFilename([$endpointName, $type, $version]);` it will call your `parseFilename` and pass all your parameters to it in the same order as well.

That's it. If you think something needs to be refactored, share your thoughts.

Note: Once all the components are built and ready,
I'll join and write the container command myself, since this cannot extend from the same abstract of all components.
it will be a stand alone command calling all the components commands and passing params to them...


Thanks and happy coding :)






## Contributing to apiato while building your project, with no effort.

### To Be Continue...
