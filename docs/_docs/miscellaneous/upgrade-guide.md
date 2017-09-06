---
title: "Upgrade Guide"
category: "Miscellaneous"
order: 20
---

## Upgrade Apiato from version 5.0 to 7.0:

> Estimated upgrading time is 30 minutes.

By upgrading to `Apiato 7.0` you can benefit from all the features provided by `Laravel 5.5`. 

*This upgrade is simple.* 

You just have to do the following changes found at the [GitHub Comparison Tool](https://github.com/apiato/apiato/compare/5.0...master).

Note: Some of the files are not required to be upgraded. And some of them, can be simply replaced by the new files (copy a file content from the Apiato repository and replace it with your older version).

Hint: You can do a git merge and solve the conflicts, if you don't want to manually do the changes commit by commit.

> **Important Information**: Laravel 5.5 introduces an `auto-discovery` feature that lets you automatically register `ServiceProviders`. 
Due to the nature and structure of APIATO applications, this features **is turned off**, because it messes up how `config` files are loaded 
in apiato. This means, that you still need to **manually** register 3rd-party `ServiceProviders` in the `ServiceProvider` of a `Container`.

## Upgrade Apiato from version 4.1 to 5.0:

> Estimated upgrading time is 15 minutes.


This guide will show you how to freshly install the new Apiato 5.0, then migrate your old project (built with Apiato 4.1) to the freshly installed one (Apiato 5.0).

*In the guide w'll be using the term **Old Project** (refering to your old project that was built with Apiato 4.1), and the term New **Project** (refering to the new freshly installed Apiato 5.0).*



1) Download and install Apiato 5.0. See [Application Setup]({{ site.baseurl }}{% link _docs/getting-started/installation.md %}).

2) Delete the Containers directory `app/Containers` from the new project.

3) Move the Containers directory `app/Containers` from the old project to the new project.

4) Open this file `app/Ship/composer.json` in your old project and only copy the required dependencies, from the old project to the same file in the new project.

5) Again, open the `app/Ship/composer.json` file in the new project, and remove the following dependencies: 
`guzzlehttp/guzzle`, `prettus/l5-repository`, `barryvdh/laravel-cors`, `spatie/laravel-fractal`, `vinkla/hashids` and `johannesschobel/apiato-container-installer`.

6) Move and replace the following directories from the old project to the new project: `config`, `public`, `resources`, `database` and `storage`.

7) Open `config/app.php` and replace `App\Ship\Engine\Providers\PortoServiceProvider::class` with `Apiato\Core\Providers\ApiatoProvider::class`.

8) Move `.gitignore`, `phpunit.xml` and `.env` files, from the old project to the new project.

9) Open the `.env` file on the new project and append this to it `API_RATE_LIMIT_ENABLED=true`.

10) Open `phpunit.xml` file of the new project and delete this line from the file `<file>./app/Ship/Engine/Loaders/FactoryMixer/FactoriesLoader.php</file>`.

11) If you had live testing data in your old project inside `app/Ship/Seeders/Data/Testing/Seeders/TestingDataSeeder.php` file, then copy that file content and past it in the new project inside `app/Ship/Seeders/SeedTestingData.php`. You will need to rename the class (not the file) from `TestingDataSeeder` to `SeedTestingData`,  
and you will need to update the namespace from `namespace App\Ship\Seeders\Data\Testing\Seeders;` to `namespace App\Ship\Seeders;`.

12) If you ever used the `HashIdTrait`, you need to search and replace this namespace `App\Ship\Engine\Traits\HashIdTrait` with this `Apiato\Core\Traits\HashIdTrait`.

13) Run `composer update`. If you got any error at this step, try to solve it or open an [Issue](https://github.com/apiato/apiato/issues).

14) Move the `.git` directory from the old project to the new one. Add all changes `git add .` then commit `git commit -m 'upgrade Apiato from 4.1 to 5.0'`. 

15) Run your tests `vendor/bin/phpunit`.

That's it :)

## How to manually upgrade older versions to 4.1?


##### Upgrading method:

1) Setup an upstream remote (to point to your fork of the apiato repository)

`git remote add upstream git@github.com:username/apiato.git`

```shell
❯ git remote -vv
origin      git@bitbucket.org:username/project-a.git (fetch)
origin      git@bitbucket.org:username/project-a.git (push)
upstream    git@github.com:apiato/apiato.git (fetch)
upstream    git@github.com:apiato/apiato.git (push)
```

2) Create apiato branch

`git checkout -b apiato`

3) Let the apiato branch track the upstream master branch

`git branch --set-upstream-to upstream/master`

```shell
❯ git branch -vv
 apiato          77b4d945 [upstream/master] ...
 master          77d302aa [origin/master] ...
```

4) Now you can move the updates to your master branch in 2 ways:


**Option A**: merge the entire apiato branch with master and solve the conflicts manually. *(easier and faster)*

`git checkout master`

The git merging can be done in many ways:

- Merge then solve the conflict manually `git merge --allow-unrelated-histories apiato` *(recommended)*
- Merge and keep your project changes `git merge --allow-unrelated-histories -X ours apiato`
- Merge and overwrite your project with the apiato changes `git merge --allow-unrelated-histories -X theirs apiato`


*-X is a shortcut for --strategy-option=*




**Option B**: Manually cherry pick from apiato to master only the commits you need:

`git checkout master`

`git log apiato`      (to copy each commit ID, one by one)

`git cherry-pick {commit-ID}`      (if you get any conflict solve it and keep moving)

<br>

Checkout the project setup in [Contributing to APIATO]({{ site.baseurl }}{% link _docs/miscellaneous/contribution.md %}).


