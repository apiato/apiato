---
title: "Contribution"
category: "Miscellaneous"
order: 6
---



Thank you for considering to contribute to APIATO. This project is powered and driven by its users. So contributions are **welcome** and will be fully **credited**.




* [Standards and Practices](#Standards-Practices)
	* [Versioning](#Versioning)
	* [Coding Standards](#Coding-Standards)
	* [Git Branches](#Git-Branches)
	* [Proposing Feature](#Proposing-Feature)
	* [Reporting Bugs](#Reporting-Bugs)
	* [Fixing Bugs](#Fixing-Bugs)
	* [Adding New Features](#Adding-New-Features)
	* [Important points to remember when contributing](#Important-points)
	* [Security Vulnerabilities](#Security-Vulnerabilities)
* [Contributing to APIATO](#Contributing-APIATO)
	* [Skeleton Project](#Contributing-Skeleton-Project)
	* [Core Package](#Contributing-Core-Package)
	* [Documentation](#Contributing-Documentation)
	* [Code Generator](#Contributing-Generator)






<a name="Standards-Practices"></a>
# Standards and Practices


<a name="Versioning"></a>
### Versioning

The project is versioned under the [Semantic Versioning](http://semver.org/) guidelines.


<a name="Coding-Standards"></a>
### Coding Standards

The project is compliant with [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md) Coding Standard,
[PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) Coding Style and some of the
[PSR-12](https://github.com/php-fig/fig-standards/blob/master/proposed/extended-coding-style-guide.md) Styles.
 
As well as it is compliant with [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) Autoloader.
*If you notice any compliance oversights, you can send a patch via pull request.*


<a name="Git-Branches"></a>
### Git Branches

The `master` branch contains the upcoming APIATO release. While the other branches are for the stable releases.

Bug fixes should be sent to the latest stable branch, never to the `master` branch, unless they fix features that exist only in the upcoming release.

Major new features should always be sent to the `master` branch, which contains the upcoming release.

**Example:**

Say we are in version `7.0` right now. The repository would have at least the following two branches `master` and `7.0` (possibly older branches as well such as `5.1`, `5.0`, `4.2`, `4.1`, `4.0` and so on). The latest stable branch in this case would be the `7.0`. The next release will be `7.1` or `8.0`.

If your PR contains a major change or a braking change, or new Container than it must be sent to the `master` branch. And if your PR fixes a bug, then it should be sent to the latest release branch.


<a name="Proposing-Feature"></a>
### Proposing Feature

If you have a proposal or a feature request, you may create an issue with `[Feature]` tag in the title, example `[Feature] Support XML responses`.

The proposal should also describe the new feature, as well as implementation ideas.
The proposal will then be reviewed and either approved or denied.
Once a proposal is approved, a pull request may be created implementing the new feature.


<a name="Reporting-Bugs"></a>
### Reporting Bugs

Bugs are tracked in our project's [issue tracker](https://github.com/apiato/apiato/issues).

When submitting a bug report, please include enough information to reproduce the bug.

A good bug report includes the following sections:

* Expected outcome
* Actual outcome
* Steps to reproduce, including sample code
* Any other information that will help us debug and reproduce the issue, including stack traces, system/environment information, and screenshots


<a name="Fixing-Bugs"></a>
### Fixing Bugs

If you see a bug report that you'd like to fix,
please feel free to do so.
Following the directions and guidelines described in the "Adding New Features" section below, you may create bugfix branches and send us pull requests.


<a name="Adding-New-Features"></a>
### Adding New Features

If you have an idea for a new feature, it's a good idea to check out our [issues](https://github.com/apiato/apiato/issues) or active [pull requests](https://github.com/apiato/apiato/pulls) first to see if the feature is already being worked on. If not, feel free to submit an issue first, asking whether the feature is beneficial to the project. This will save you from doing a lot of development work only to have your feature rejected.

When you do begin working on your feature, here are some guidelines to consider:

* **Write tests** for any new features you add. (code without tests could be accepted in some cases).
* **Ensure that tests pass** before submitting your pull request. We have Travis CI automatically running tests for pull requests. However, running the tests locally will help save time.
* **Use topic/feature branches.**
* **Submit one feature per pull request.** If you have multiple features you wish to submit, please break them up into separate pull requests.
* **Send coherent history**. Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please squash them before submitting.
* **Update the Documentation**.



<a name="Important-points"></a>
### Important points to remember when contributing:

- Be descriptive in your branch names, commit messages, and pull request title and descriptions.
- Keep your commits atomic, that is, each commit should represent a single unit of change. (Also, remember to write helpful commit messages.)
- Once you have a pull request for a branch, you can push additional changes to the same branch and they will be added to the pull request automatically. You should never create a new pull request for the same branch.
- Comment on the pull request when you want people to know that you have pushed new changes. Although GitHub does notify people of commit pushes, people are more likely notice your changes if you leave a comment.
- Before writing any line of code, run the tests, and make sure all the tests passed in your environment. This will save you time, worrying of your changes caused those tests to fail.



<a name="Security-Vulnerabilities"></a>
### Security Vulnerabilities

If you discover a security vulnerability, please send email to `mahmoud@zalt.me`.




<br>


___

<a name="Contributing-APIATO"></a>
# Contributing to APIATO

> The project consist of 2 repositories `apiato/apiato` (the project skeleton, with default containers) and `apiato/core` (the core package of apiato).


<a name="Contributing-Skeleton-Project"></a>
## Contributing to the Skeleton Project

The APIATO skeleton, is the actual Apiato project on the repository `apiato/apiato`.

This guide will help you contribute to the APIATO skeleton project, while working on your personal project. So you don't have to write the code twice, which makes contribution fun an fast.



### SETUP

**One time setup**

In this scenario let's assume we have the following:

* `Apiato`     # is the starter/framework project
* `Project A`  # your personal project your building on top of apiato



1) Create Project A from APIATO

`composer create-project apiato/apiato project-a`

2) Initialize git in Project A

`git init`

3.a) Setup your origin remote (to point to your project private repository url)

`git remote add origin git@bitbucket.org:username/repo.git`

*if you already have origin remote then update it with*

`git remote set-url origin git@bitbucket.org:username/project-a.git`


3.b) Setup an upstream remote (to point to your fork of the apiato repository)

*assuming you already forked the repository*

`git remote add upstream git@github.com:username/apiato.git`

Now you should have the following remotes:

```
❯ git remote -vv
origin      git@bitbucket.org:username/project-a.git (fetch)
origin      git@bitbucket.org:username/project-a.git (push)
upstream    git@github.com:username/apiato.git (fetch)
upstream    git@github.com:username/apiato.git (push)
```

4.a) Create apiato branch

`git checkout -b apiato`

4.b) Let the apiato branch track the upstream master branch

`git checkout apiato`

`git branch --set-upstream-to upstream/master`

Now you should have the following branches:

```
❯ git branch -vv
 apiato           77b4d945 [upstream/master] ...
 master           77d302aa [origin/master] ...
```

### USAGE (Contribution Steps)

**Must do every time before you contribute**

1) Update remotes (fetch)

`git fetch --all`

2) Go to the apiato branch 

`git checkout apiato`

3) Apply the changes of upstream master in the local apiato branch

`git pull`    (this will pull from the upstream since this apiato branch is configured to track upstream)

Or use `git reset --hard upstream/master` if you want to override your local changes on that branch


4) Now you can cherry pick from master to apiato any commit you'd like to contribute:

`git checkout apiato`

`git log master`      (to copy each commit ID, one by one)

`git cherry-pick {commit-ID}`

*(repeat for all commits you want to submit)*

5) push apiato branch to the upstream

`git push upstream apiato:master`

6) create a Pull Request (PR) from your forked repository to the apiato official repository.

*W'll do our best to merge your PR in the shortest time possible. Thanks in advanced :)*

Checkout [How to upgrade apiato]({{ site.baseurl }}{% link _docs/miscellaneous/faq.md %}).




<br>

<a name="Contributing-Core-Package"></a>
## Contributing to the Core Package

The APIATO core package, is what provies most of the functionality of the APIATO project. 

This guide will help you contribute to the APIATO core package, while the package is in the vendor direcotry.


### SETUP

1) For the project `apiato/core`.

1) Pull the package to the project vendor (even if it was there) using:

`composer update {your-username}/core --prefer-source`


_The composer option `--prefer-source` will clone the package's git repository inside the vendor directory, so you can commit and push from the vendor directory directly._


2) Go to `vendor/apiato/core/` from the terminal to access the package Git, in order to commit.


### USAGE (Contribution Steps)

Edit > Commit > Push > PR :)





<br>

<a name="Contributing-Documentation"></a>
## Contributing to the Documentation

The documentation is generated using [Jekyll](https://jekyllrb.com/) and it lives in the `/docs` folder. 

### Run the docs locally: 

#### In Docker:

1. `cd .../apiato/docs`
2. `docker run -v $PWD:/srv/jekyll -p 4000:4000 -it jekyll/jekyll bash` 
3. `bundle install`
4. `jekyll serve`
5. Browse `http://localhost:4000`

#### Natively:

1. Install (Jekyll)[https://jekyllrb.com/] and its dependencies.
2. `cd docs/`
3. `bundle install`
4. `bundle exec jekyll serve`
5. Browse `http://localhost:4000`
6. Finally `jekyll build`

### Documentation Tips:

The content of the documentation can be found in the `docs/_docs` folder.

The styles are in `main.scss` and `docs/_sass/*`.

The Layout `docs/_layouts/default.html`.

The docs folders `_docs/*` do not represent the categories displayed in the site. 

To add new category for a file `category: "New Category"` (usually defined in each documentation readme) 
you must add the category name to `docs/_config.yml` under `categories-order` in order to appear in the site. 

To set a link, use the internal links as follow: `[your-text]( { { site.baseurl } } { % link _docs/path/file.md % } )`. NOET: reomve the spaces between the tags








<br>

<a name="Contributing-Generator"></a>
## Contributing to the Code Generator

The Code generator is part of the `apiato/core` package.

- Repository: `apiato/core`.
- Code Path: `/Generator`.

Each component command, "Except the Containers Generator" must extend from the `Apiato\Core\Generator\GeneratorCommand.php`.

This abstract class does all the work for you.

### Add new component generator.

1 - Add create new command by copy pasting any of the demo commands provided. The `Generator/Commands/RouteGenerator.php` is great example.

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
  

2 - Create the stub to be loaded in `Generator/Stubs`, copy any real component code and build the stub out of it.

3 - Finally register the command in `Generator/GeneratorsServiceProvider.php` using `registerGenerators`, example:

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






