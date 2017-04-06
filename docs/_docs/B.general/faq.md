---
title: "Frequently Asked Questions"
category: "General"
order: 3
---


## How to use my custom domain?

Change the default URL from `apiato.dev` to `awesome.com`

1) open your hosts (`sudo vi ect/hosts`) file and map your domain `awesome.com` to the IP address of your Virtual Host (Docker IP or Vagrant IP) or any host you are using in case you have the tools installed locally on your machine.

2) open the .env file and replace `apiato.dev` with `awesome.com` in `APP_URL`, and `API_URL` *(note the API domain should be api.*)*

3) open `phpunit.xml` and change `API_BASE_URL` from `apiato.dev` to `awesome.com`



## Where to put my frontend code?

The front-end Apps code should be in the `clients/web/` directory, separated from the Server code (apiato Code).

The front-end App should be able to run as a stand alone App, and it will consume the Server API.

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

But if you still want to serve your front-end code from the apiato Containers, you can do that easily. It's just not recommended!



### Where do I register Service Providers and Aliases?

Most of the third party packages Service Providers and Aliases SHOULD be registered inside the Container's Main Service Providers, inside the `$serviceProviders` and `$aliases` properties. However, some more general Service Providers and Aliases (application features used by all containers) CAN be registered inside the Engine Main `PortoServiceProvider`.

Refer to the [Providers](http://apiato.io/D.components/providers/) page for more details.



### Where do I define the composer dependencies?

All the composer dependencies should be defined in their Containers, in a composer.json file.



### How to enable Query Caching?

By default this feature is turned off.

To turn it on, go to the `.env` file and set `ELOQUENT_QUERY_CACHE=true`. The query result will be cleared on `create`, `update` and `delete`. However all these configurations can be changed from `Ship/Features/Configs/repository.php`.
