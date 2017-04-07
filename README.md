# apiato

[![apiato](https://img.shields.io/badge/Status-Awesome-brightgreen.svg)](https://github.com/apiato/apiato)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/apiato/apiato/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/apiato/apiato/?branch=master)
[![Build Status](https://travis-ci.org/apiato/apiato.svg?branch=master)](https://travis-ci.org/apiato/apiato)
[![Latest Stable Version](https://poser.pugx.org/apiato/apiato/v/stable)](https://packagist.org/packages/apiato/apiato)
[![Latest Unstable Version](https://poser.pugx.org/apiato/apiato/v/unstable)](https://packagist.org/packages/apiato/apiato)
[![Dependency Status](https://www.versioneye.com/user/projects/578988f4c3d40f0046852116/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/578988f4c3d40f0046852116)
[![Build Status](https://scrutinizer-ci.com/g/apiato/apiato/badges/build.png?b=master)](https://scrutinizer-ci.com/g/apiato/apiato/build-status/master)
[![composer.lock](https://poser.pugx.org/apiato/apiato/composerlock)](https://packagist.org/packages/apiato/apiato)
[![License](https://poser.pugx.org/apiato/apiato/license)](https://packagist.org/packages/apiato/apiato)


> Build better API's faster with **PHP** and **Laravel 5.4**.

[![forthebadge](http://forthebadge.com/images/badges/ages-12.svg)](http://apiato.io)



*`Hello API` was the first name of this project, it was renamed to `apiato` in March, 22, 2017 for no reason.*


<a name="Introduction"></a>
## Into


### What is `apiato`

**apiato** is a starter project, designed to help you build scalable API's faster, by providing tools and
functionalities that facilitates the development of any API-Centric Applications.

apiato uses the best frameworks, tools and conventions in a very creative way to deliver a modern PHP Application.

Why!? setting up a solid API from scratch is time consuming (and time is money).
apiato gives you the core features of robust API's, so you can focus on your business logic and deliver faster.
Skip the repetitive work and enjoy the open source fun.


#### Intro to API-Centric Apps

Today we’re living in a digital era, where almost everything is connected to the Internet.

Building cross-devices applications is becoming a must. And to do it, you need APIs (Application Programing Interfaces).

Web developers are used to serve HTML pages directly from the Backend. However, this traditional method has many disadvantages nowadays.

API's can serve anything and everything (Mobile Apps, Web Apps, Smart TVs, Smart Watches,...).
As well as, it can be exposed to the world allowing developers to interact with your Application and help growing your business.

API-Centric Apps allows Frontend (Web + Mobile) and Backend developers to work on their codes in parallel. After the Frontend Apps are ready they get attached to the Backend (API-Centric) code to start functioning. This leads to zero decoupling between the Frontend and the Backend code and also removes the dependencies. The API documentation acts as the contract between both sides during the development life cycle of all the Apps.




<a name="Features"></a>
## Features

>The apiato comes with great features:

- OAuth2.0 authentication for first and third-party clients (using Laravel Passport).
- Role-Based Access Control (RBAC), seeded with a Super Admin, Roles and  Permissions.
- Query Parameters support (orderBy, sortedBy, filter, include) with full-text search (search, searchFields).
- Useful endpoints for managing users, roles/permissions, tokens and more, all implemented, documented and covered with functional Tests.
- Easy API Documentations generator (using the ApiDocJS tool).
- Supports for CORS "Cross-Origin Resource Sharing", allowing access from different domians.
- Auto encoding/decoding of real ID's, to prevent exposing real ID's to the outer world.
- API Throttling (Rate Limiting).
- Exception handleing with custom JSON errors responses.
- Data Caching support (with auto clearing on Create, Update and Delete).
- Easy API versioning in the URL, through the route files names.
- Social Authentication supported out of the box (Facebook, Twitter, Google+).
- Localization support (multiple languages via Content-Language header).
- Automatic Data Pagination (meta links to next and previous data).
- Http Requests/Response Monitor and DB Query Debugger (from the Debugger Container).
- Type-Casting JSON responses with Transformers (Using Fractal).
- Custom Tests Helpers for faster and more enjoyable automated testing (using PHPUnit).
- Optional support for the JSON API specification v1.0.
- Automatic dates conversion to ISO format in responses.
- Optional support for JSON with padding (JSONP).
- Support Stripe payment gateways (easy to extend and cover other gatways).
- WEB and API Authentication Middlewares.
- Maintainable and scalable Software Architectural Pattern (using Porto SAP).
- Code generator, allows generating Containers of code for faster development.
- Separation of Web, API and CLI routes, controllers, requests and more.
- Ready Admin dashboard infrastructure.
- Fully detailed documentation (on apiato.io).
- 100% customizable and Open Code.
- And much more...

<br>

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/1bdf99d7-13b1-46ca-8576-c6a702f9afd7/big.png)](https://insight.sensiolabs.com/projects/1bdf99d7-13b1-46ca-8576-c6a702f9afd7)


<a name="Documentation"></a>
## Documentation

**apiato** is built with a new architectural pattern called **[Porto](https://github.com/Mahmoudz/Porto)**.
> **Porto SAP** is a modern Software Architectural Pattern, designed to help developers organize their Code in a super maintainable way. It is very helpful for big and long term projects, as they tend to have higher complexity with time.

Reading the simple [**Porto document**](https://github.com/Mahmoudz/Porto) is essential before starting.


### apiato full [documentation](http://apiato.io/) here.




<a name="Chat"></a>
## Get in touch

Join our [Slack](https://apiato.slack.com/shared_invite/MTYyMzk3MzIzNjIxLTE0OTA5MDE0NTMtOTljOGU1NmFlZQ) chatting room, by click on the Slack icon below.

[![](https://s19.postimg.org/h7pvzy9ar/Slack-i_OS-icon.png)](https://now-examples-slackin-bvfqosqozk.now.sh)





<a name="Credits"></a>
## Credits

| Contributors                                | Twitter                                           | Contact         | Site                                |
|---------------------------------------------|---------------------------------------------------|-----------------|-------------------------------------|
| [Mahmoud Zalt](https://github.com/Mahmoudz) | @[Mahmoud_Zalt](https://twitter.com/Mahmoud_Zalt) | mahmoud@zalt.me | [https://zalt.me](https://zalt.me/) |


<a name="Donations"></a>
## Donations

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/mzalt) 

[![Beerpay](https://beerpay.io/apiato/apiato/badge.svg?style=flat)](https://beerpay.io/apiato/apiato)


<a name="License"></a>
## License

The MIT License [(MIT)](https://opensource.org/licenses/MIT).
