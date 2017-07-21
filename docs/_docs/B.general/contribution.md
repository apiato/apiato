---
title: "Contribution"
category: "General"
order: 4
---


Thank you for considering to contribute to APIATO. This project is powered and driven by its users. So contributions are **welcome** and will be fully **credited**.



# Standards and Practices

### Versioning

The project is versioned under the [Semantic Versioning](http://semver.org/) guidelines.



### Coding Standards

The project is compliant with [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md) Coding Standard,
[PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) Coding Style
and the [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) Autoloader.
*If you notice any compliance oversights, you can send a patch via pull request.*



## Git Branches

The `master` branch contains the upcoming APIATO release. While the other branches are for the stable realsese.

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



# Contributing to APIATO's Documentation:

The documentation is generated using (Jekyll)[https://jekyllrb.com/] and it lives in the `/docs` folder. 

The content of the documentation can be found in the `docs/_docs` folder.

The styles are in `main.scss` and `docs/_sass/*`.
Layout `docs/_layouts/default.html`.


### To run the docs locally: 

#### In Docker:

1. `cd .../apiato/_docs`
2. `docker run -v $PWD:/srv/jekyll -p 4000:4000 -it jekyll/jekyll bash` 
3. `bundle install`
4. `jekyll serve`
5. Browse `http://localhost:4000`
6. Finally `jekyll build`

#### Natively:

1. Install (Jekyll)[https://jekyllrb.com/] and its dependencies.
2. `cd docs/`
3. `bundle install`
4. `bundle exec jekyll serve`
5. Browse `http://localhost:4000`



# Contributing to the Code Generator:

Code Path: `app/Ship/Generator`.
Commands paths: `app/Ship/Generator/Commands`.

Each component command, "Except the Containers Generator" must extend from the `app/Ship/Generator/GeneratorCommand.php`.

This abstract class does all the work for you.

#### Add new component generator.

1 - Add create new command by copy pasting any of the demo commands provided. The `app/Ship/Generator/Commands/RouteGenerator.php` is great example.

For each generator you need to implement exactly one method (as it is defined in the respective interface)

- `getUserInputs:` 
    This method reads all parameters from the command line or provides a wizard to get information from the user.
    The available options for this generator are specified using the `public $inputs = []` variable in respective generator.
    Note that you do not need to specify the options for `--container` or `--file`, as both are handled directly by the 
    Generator itself. Simply add the options that are specifically needed for this generator.
    
    Be sure to read input with the `checkParameterOrXYZ()` methods, as they automatically check if an option is available. 
    Otherwise, they will ask the user for additional input.
    
    The method must return an array of 3 keys:
  - `path-parameters` are used to replace variables within the path where the generator creates the file.
  - `file-parameters` are used to replace variables within the name of the file to be created.
  - `stub-parameters` are used to replace variables within the stub.
  

2 - Create the stub to be loaded in `app/Ship/Generator/Stubs`, copy any real component code and build the stub out of it.

3 - Finally register the command in `app/Ship/Generator/GeneratorsServiceProvider.php` using `registerGenerators`, example:

```php
        $this->registerGenerators([
            'Action',
            'Route',
            'Task',
            // ...
        ]);
```

4 - Default Filename (optional)

You may provide another default filename by overriding the `getDefaultFileName()` method, which simply returns a `string`.

5 - Enjoy your Generator

That's it.. It's really that easy!

Note: Once all the components are built and ready,
I'll join and write the container command myself, since that cannot extend from the same abstract class of the components.
It should be a stand alone command, which basically calls the components commands and pass user inputs to them.



# Contributing to APIATO while working on your project:

#### To Be Continue...


