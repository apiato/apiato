---
title: "Contribution"
category: "General"
order: 4
---


Thank you for considering to contribute to apiato. This project is powered and driven by its users. So contributions are **welcome** and will be fully **credited**.



# Standards and Practices

### Versioning

The project is versioned under the [Semantic Versioning](http://semver.org/) guidelines.



### Coding Standards

The project is compliant with the [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) coding standard
and the [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) autoloading standard.
*If you notice any compliance oversights, you can send a patch via pull request.*



## Git Branches

The `master` branch contains the upcoming apiato release. While the other branches are for the stable realsese.

Bug fixes should be sent to the latest stable branch, never to the `master` branch unless they fix features that exist only in the upcoming release.

Major new features should always be sent to the `master` branch, which contains the upcoming release.



## Proposing Feature

If you have a proposal or a feature request, you may create an issue with `[Feature]` in the title (`[Feature] support XML responses`).

The proposal should also describe the new feature, as well as implementation ideas.
The proposal will then be reviewed and either approved or denied.
Once a proposal is approved, a pull request may be created implementing the new feature.


## Reporting Bugs

Bugs are tracked in our project's [issue tracker](https://github.com/apiato/apiato/issues).

When submitting a bug report, please include enough information to reproduce the bug.

A good bug report includes the following sections:

* Expected outcome
* Actual outcome
* Steps to reproduce, including sample code
* Any other information that will help us debug and reproduce the issue, including stack traces, system/environment information, and screenshots


## Fixing Bugs

If you see a bug report that you'd like to fix,
please feel free to do so.
Following the directions and guidelines described in the "Adding New Features" section below, you may create bugfix branches and send us pull requests.



## Adding New Features

If you have an idea for a new feature, it's a good idea to check out our [issues](https://github.com/apiato/apiato/issues) or active [pull requests](https://github.com/apiato/apiato/pulls) first to see if the feature is already being worked on. If not, feel free to submit an issue first, asking whether the feature is beneficial to the project. This will save you from doing a lot of development work only to have your feature rejected.

When you do begin working on your feature, here are some guidelines to consider:

* **Write tests** for any new features you add. (code without tests could be accepted in some cases).
* **Ensure that tests pass** before submitting your pull request. We have Travis CI automatically running tests for pull requests. However, running the tests locally will help save time.
* **Use topic/feature branches.**
* **Submit one feature per pull request.** If you have multiple features you wish to submit, please break them up into separate pull requests.
* **Send coherent history**. Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please squash them before submitting.
* **Update the Documentation**.




## Important points to remember when contributing:

- Be descriptive in your branch names, commit messages, and pull request title and descriptions.
- Keep your commits atomic, that is, each commit should represent a single unit of change. (Also, remember to write helpful commit messages.)
- Once you have a pull request for a branch, you can push additional changes to the same branch and they will be added to the pull request automatically. You should never create a new pull request for the same branch.
- Comment on the pull request when you want people to know that you have pushed new changes. Although GitHub does notify people of commit pushes, people are more likely notice your changes if you leave a comment.
- Before writing any line of code, run the tests, and make sure all the tests passed in your environment. This will save you time, worrying of your changes caused those tests to fail.




## Security Vulnerabilities

If you discover a security vulnerability, please send email to `mahmoud@zalt.me`.





# Contributing to the Code Generator:

Code Path: `app/Ship/Generator`.
Commands paths: `app/Ship/Generator/Commands`.

Each component command, "Except the Containers Generator" must extend from the `app/Ship/Generator/GeneratorCommand.php`.

This abstract class does all the work for you.

#### Add new component generator.

1 - Add create new command by copy pasting any of the demo commands provided. The `app/Ship/Generator/Commands/RouteGenerator.php` is great example.

Each component should have 3 functions:

- `getUserInputs:` returns an array of 2 keys: the `stub-parameters` (are ordered parameters that will be passed to `getStubRenderMap`). And `file-parameters` (are ordered parameters that will be passed to `getFileNameParsingMap`).
- `getStubRenderMap:` returns array mapping keys and values to be replaced in the stub.
- `getFileNameParsingMap:` returns array mapping keys and values to be replaced in file name (`$nameStructure`).

2 - Create the stub in `app/Ship/Generator/Stubs`, copy any real component code and build the stub out of it.

3 - Finally register the command in `app/Ship/Generator/GeneratorsServiceProvider.php` using `registerGenerators`, example:

```php
        $this->registerGenerators([
            'Action',
            'Route',
            'Task',
            // ...
        ]);
```

That's it.

Note: Once all the components are built and ready,
I'll join and write the container command myself, since that cannot extend from the same abstract class of the components.
It should be a stand alone command, which basically calls the components commands and pass user inputs to them.













# Contributing to apiato while working on your project:

#### To Be Continue...


