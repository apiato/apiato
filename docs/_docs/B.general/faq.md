---
title: "Frequently Asked Questions"
category: "General"
order: 3
---


## Do I have to use the Porto SAP to benefit from apiato!?

NO. You can still use the standard MVC (Controllers are still there) or any other architecture you prefer.
And you can call the apiato provided `Actions` and `Tasks` from your Controllers or Services or whichever classes you prefer.
You have the freedom to structure your own project anyway you like, and still use all the feature that apiato provide.


## How to use my custom domain?

Change the default URL from `apiato.dev` to `awesome.com`

1) open your hosts (`sudo vi ect/hosts`) file and map your domain `awesome.com` to the IP address of your Virtual Host (Docker IP or Vagrant IP) or any host you are using in case you have the tools installed locally on your machine.

2) open the .env file and replace `apiato.dev` with `awesome.com` in `APP_URL`, and `API_URL` *(note the API domain should be api.*)*

3) open `phpunit.xml` and change `API_BASE_URL` from `apiato.dev` to `awesome.com`


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

However, apiato does support serving HTML from within. So only of you prefer, you can serve HTML from apiato directly same as you are serving the API.

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


### Where do I register Service Providers and Aliases?

Most of the third party packages Service Providers and Aliases SHOULD be registered inside the Container's Main Service Providers, inside the `$serviceProviders` and `$aliases` properties. However, some more general Service Providers and Aliases (application features used by all containers) CAN be registered inside the Engine Main `PortoServiceProvider`.

Refer to the [Providers](http://apiato.io/D.components/providers/) page for more details.


## How to access my API using URL `example.com/api/` instead of subdomain `api.example.com`? 

1. open `RoutesLoaderTrait` find `loadApiRoute` function
2. set prefix to `'prefix' => 'api/' . $versionPrefix,` 
3. open `.env` change your api domain to `API_URL=http://example.com`


## How to version my API in header instead of URL? 

First remove the URL versioning:
1. open `RoutesLoaderTrait` find `loadApiRoute` function
2. remove the prefix `'prefix' => $versionPrefix,`
 
Second Implement the Header versioning anyway you prefere.


### Where do I define the composer dependencies?

All the composer dependencies should be defined in their Containers, in a composer.json file.

*The Ship layer dependencies live on the root of the Ship layer in a composer.json file. Finally the 
Framework core dependencies live on the project root composer.json file*.



### How to enable Query Caching?

By default this feature is turned off.

To turn it on, go to the `.env` file and set `ELOQUENT_QUERY_CACHE=true`. The query result will be cleared on `create`, `update` and `delete`. However all these configurations can be changed from `Ship/Configs/repository.php`.



## Can I name my Actions `IndexAction`, `ShowAction`, `StoreAction`.. according to REST? 

You can name anything, anyway you prefer, sa long as you’re just changing the name and not the naming format 
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



## I have a question and I can't find answer!!

If you have a question, or didn't find an answer you were looking for. 
First make sure your question is related to apiato and is not a general question.  
If so, then consider visiting the [apiato's Github Issues](https://github.com/apiato/apiato/issues) and searching for  
*keywords* related to your issue *(filter open and closed issues)*. 
Another option you have is to get help from the communty on [Slack](https://now-examples-slackin-bvfqosqozk.now.sh).

Lastly, if you got your question answered, consider sharing it, if you believe it can help others. 
You can submit a PR adding the questions and answer here on the FAQ page. 
Or leave it somewhere on the repository or on Slack. Thanks in advanced :)


