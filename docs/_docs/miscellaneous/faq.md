---
title: "Frequently Asked Questions"
category: "Miscellaneous"
order: 5
---

* [Do I have to use the Porto Architecture to benefit from APIATO](#q1)
* [How to use my custom domain?](#q2)
* [Where to put my frontend code?](#q3)
* [Where do I register Service Providers and Aliases?](#q4)
* [How to change API URL?](#q5)
* [How to version my API in header instead of URL?](#q6)
* [Where do I define my Composer dependencies?](#q7)
* [How to enable Query Caching?](#q8)
* [Can I give my Actions REST names?](#q9)
* [How Service Providers are auto-loaded?](#q11)
* [Why Laravel 5.5 Auto-Discovery feature not working?](#q12)
* [I have a question and I can't find answer!!](#q100)

<br>

<a name="q1"></a>
## Do I have to use the Porto Architecture to benefit from APIATO!?

NO. You can still use the standard MVC (Controllers are still there) or any other architecture you prefer.
And you can call the APIATO provided `Actions` and `Tasks` from your Controllers or Services or whichever classes you prefer.
You have the freedom to structure your own project anyway you like, and still use all the feature that APIATO provide.


<a name="q2"></a>
## How to use my custom domain?

Change the default URL from `apiato.dev` to `awesome.com`

1) Edit your hosts file `sudo vi ect/hosts`, and map your domain `awesome.com` to the IP address of your Virtual Host (Localhost, Docker IP, Vagrant IP, ...)

2) Edit the `.env` file and replace `apiato.dev` with `awesome.com` in `APP_URL`, and `API_URL` *(note the API domain should be api.*)*

3) Edit the `phpunit.xml` file and change `API_BASE_URL` from `apiato.dev` to `awesome.com`


<a name="q3"></a>
## Where to put my frontend code?

It's recommended that the front-end Apps code live outside apiato completely. Example in `clients/web/` directory, separated from the Server code (apiato Code).

The front-end App should be able to run as a stand alone App, and it can consume the Server API or other Testing API's.

You can configure NGINX to server the Front-end and the Back-end each on a different domain or on subdomains *(Example `app.com` for the front-end App and `api.app.com` for the API)*.

**Example project structure:**

```
- MyProject
  - Server
    - Api   // < apiato Code
  - Clients
    - Web
      - Main App   // < Web App code (HTML, CSS, JS, ...)
    - Mobile
      - Android   // < Android App code
      - iOS   // < iPhone App code
```

However, apiato does support serving HTML from within. So only of you prefer, you can serve HTML from apiato directly same as serving the API.

In this case the code will live in:

```
- MyProject
  - app
    - Containers
      - Container-X
        - UI
          - API
          - WEB  // << 
            - Views
          - CLI
      - Container-Y
        - UI
          - API
          - WEB  // << 
            - Views
          - CLI
```

<a name="q4"></a>
### Where do I register Service Providers and Aliases?

Most of the third party packages Service Providers and Aliases SHOULD be registered inside the Container's Main Service Providers, inside the `$serviceProviders` and `$aliases` properties. 
However, some more general Service Providers and Aliases (application features used by all containers) CAN be registered on the Ship layer in `app/Ship/Providers/ShipProvider.php` inside the `$serviceProviders` and `$aliases` properties.

Refer to the [Providers]({{ site.baseurl }}{% link _docs/components/providers.md %}) page for more details.

> **Important Information**: Laravel 5.5 introduces an `auto-discovery` feature that lets you automatically register `ServiceProviders`. 
Due to the nature and structure of APIATO applications, this features **is turned off**, because it messes up how `config` files are loaded 
in apiato. This means, that you still need to **manually** register 3rd-party `ServiceProviders` in the `ServiceProvider` of a `Container`.

<a name="q5"></a>
## How to change the default API URL (Subdomain and Prefix)?

By default Apiato uses `api.` as subdomain for all endpoints. And adds only the `v1` API version as prefix.

To change this from `api.apiato.com` to `apiato.com/api/`, do the following:

1. Edit `.env`, change your api domain to `API_URL=http://apiato.com` instead of `API_URL=http://api.apiato.com` to remove the subdomain.
2. Edit `app/Ship/Configs/apiato.php`, set prefix to `'prefix' => 'api/',`.
3. That's it. Now you might need to update your tests endpoints, if they fail. Since each test can specify which endpoint to test, Example: In `CreateAdminTest` change `protected $endpoint = 'post@v1/admins';` to `protected $endpoint = 'post@api/v1/admins';`, including the new prefix.

To remove the version prefix as well, set `enable_version_prefix` to `false` in `app/Ship/Configs/apiato.php`.



<a name="q6"></a>
## How to version my API in header instead of URL? 

First remove the URL version prefix:
1. Edit `app/Ship/Configs/apiato.php`, set prefix to `'enable_version_prefix' => 'false',`.
2. Implement the Header versioning anyway you prefer. (this is not implemented in Apiato yet. _Consider a contribution_).



<a name="q7"></a>
## Where do I define my Composer dependencies?

All the Composer dependencies should be defined in their Containers, in a `composer.json` file.

*The Ship layer dependencies live on the root of the Ship layer in a `composer.json` file. 
Finally the Framework core dependencies live on the project root `composer.json` file*.

Basically using any of the `composer.json` will do the same job. it's up to you to pick the most relevant location.


<a name="q8"></a>
## How to enable Query Caching?

By default this feature is turned off.

To turn it on, go to the `.env` file and set `ELOQUENT_QUERY_CACHE=true`. The query result will be cleared on `create`, `update` and `delete`. 
 
_All these configurations can be changed from `Ship/Configs/repository.php`_.


<a name="q9"></a>
## Can I give my Actions REST names? 

Example: `IndexAction`, `ShowAction`, `StoreAction`...

Yes, you can name anything, anyway you prefer, sa long as you’re just changing the name and not the naming format 
*“like in case of routes files, they include the version number which gets applied to the api, 
and the api type to help adding the route file to different docs automatically”*.

The goal of giving the Actions and Tasks… a descriptive long names is, to be able to understand what’s going on 
inside the class before opening it, and there’s a feature that I will add to the generator later, 
that will list all the use cases “Actions” in your system, so you can see what you already implemented and what 
needs to be done. If you’re Action name is “ShowAction” you will see 50 of them without really knowing what 
the action is doing!,  

I prepend the container name before the action name, but still a maintainable code means anyone who reads it can 
understand it without any explanation from the original writer!.. 
so I personally prefer `ShowTotalNumberOfUsersActions` than `ShowAction`.

Back to that future feature, here’s how it works: 
imagine you can add all your endpoints “routes files” with no implementation and then implement them one by 
one “similar to TDD/BDD” with the help of a command that tells what you already have been completed and what 
needs to be completed.. as well as what Tasks are available to be used from any Action..


<a name="q11"></a>
## How Service Providers are auto-loaded?

Each Container has Main Provider and other Providers (Additional Providers). 
When `runLoadersBoot()` is called it auto register all the Main Providers from all the Containers. 

Each main provider calls its`boot()` function after being registered, which calls `loadServiceProviders()` to register all the other container Providers. 
The other providers must be defined on its `$serviceProviders` property, otherwise will be ignored.

On the other side the `ApiatoServiceProvider` is manually registered on the `app.php` file (and it's the only one registered there). 

The `ApiatoServiceProvider` is the one who calls the `runLoadersBoot()`, on startup. 
After he call that function he registers the Ship Providers which has all the other Ship Providers defined on its `$serviceProviders` property.

> **Important Information**: Laravel 5.5 introduces an `auto-discovery` feature that lets you automatically register `ServiceProviders`. 
Due to the nature and structure of APIATO applications, this features **is turned off**, because it messes up how `config` files are loaded 
in apiato. This means, that you still need to **manually** register 3rd-party `ServiceProviders` in the `ServiceProvider` of a `Container`.


<a name="q12"></a>
## Why Laravel 5.5 Auto-Discovery feature not working?

That is, because this feature is turned off by default in APIATO. The Laravel `Auto-Discovery` feature registers 3rd-party 
Service Providers during startup of the application and thereby messes with the way, APIATO handles / loads components. 
This is especially in the context of `config` files problematic, as they are ignored.

To re enable it go to the main `composer.json` file and remove the "*" from the `dont-discover`
```json
  "extra": {
    "laravel": {
      "dont-discover": [
        "*"
      ]
    },
```

After enabling the Auto-Discovery, you must move all the config files from the Containers and the Ship layer to the original config folder of Laravel. 
Otherwise they won't be loaded (except your custom Configs "config files that doesn't belong to a composer package", they will still work fine). 

> You **must** register 3rd-party Service Providers on your own in the `MainServiceProvider` of respective Container 
(i.e., same like in Laravel 5.4 and before).

















<a name="q100"></a>
## I have a question and I can't find answer!!

If you have a question, or didn't find an answer you were looking for. 
First make sure your question is related to apiato and is not a general question.  
If so, then consider visiting the [apiato's Github Issues](https://github.com/apiato/apiato/issues) and searching for  
*keywords* related to your issue *(filter open and closed issues)*. 
Another option you have is to get help from the community on [Slack](https://now-examples-slackin-bvfqosqozk.now.sh).

Lastly, if you got your question answered, consider sharing it, if you believe it can help others. 
You can submit a PR adding the questions and answer here on the FAQ page. 
Or leave it somewhere on the repository or on Slack. Thanks in advanced :)
