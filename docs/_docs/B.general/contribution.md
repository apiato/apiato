---
title: "Contribution"
category: "General"
order: 4
---



## How to contribute to the Components Generator:

Code Path: `app/Ship/Generator`.
Commands paths: `app/Ship/Generator/Commands`.

Each component command, "Except the Containers Generator" must extend from the `app/Ship/Generator/GeneratorCommand.php`.

This abstract class does all the work for you.

#### Add new component generator.

1. Add create new command by copy pasting any of the demo commands provided. The `app/Ship/Generator/Commands/RouteGenerator.php` is great example.

Each component should have 3 functions:

- `getUserInputs:` returns an array of 2 keys: the `stub-parameters` (are ordered parameters that will be passed to `getStubRenderMap`). And `file-parameters` (are ordered parameters that will be passed to `getFileNameParsingMap`).
- `getStubRenderMap:` returns array mapping keys and values to be replaced in the stub.
- `getFileNameParsingMap:` returns array mapping keys and values to be replaced in file name (`$nameStructure`).

2. Create the stub in `app/Ship/Generator/Stubs`, copy any real component code and build the stub out of it.

That's it.

Note: Once all the components are built and ready,
I'll join and write the container command myself, since that cannot extend from the same abstract class of the components.
It should be a stand alone command, which basically calls the components commands and pass user inputs to them.


Happy coding :)



## Contributing to apiato while building your project, with no effort.

### To Be Continue...
