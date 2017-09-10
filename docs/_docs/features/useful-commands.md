---
title: "Useful Commands"
category: "Features"
order: 103
---

- [Available Commands](#available-commands)
- [List All Actions Command](#list-all-actions-command)

<br>
<br>

Apiato is shipped with many useful commands to help you speed up the development process.
You can see list of all commands, by typing `php artisan` and look for **Apiato** section.

<a name="available-commands"></a>

## Available Commands

- Generator Commands [more details]({{ site.baseurl }}{% link _docs/features/code-generator.md %}).
- Documentation Generator Command [more details]({{ site.baseurl }}{% link _docs/features/api-docs-generator.md %}).
- Additional Commands
    - List Actions: `php artisan apiato:actions` List all Actions in the Application
    - Encode an ID `php artisan apiato:encode` See the encoding of an ID
    - Seed Testing Data: `php artisan apiato:seed-test` Seeds your custom testing data from `app/Ship/Seeders/SeedTestingData.php`.
    - Seed Deployment Data: `php artisan apiato:seed-deploy` Seeds your custom deployment data from `app/Ship/Seeders/SeedDeploymentData.php`.

<a name="list-all-actions-command"></a>

## List All Actions Command

It's useful to be able to see all the implemented use cases in your application. To do so type
`php artisan apiato:actions`

You can also pass `--withfilename` flag to see all Actions with the files names.  
`apiato:actions --withfilename`

![]({{ site.baseurl }}/images/documentation/actions-commands.png)
