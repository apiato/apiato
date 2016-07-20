# Hello API


![](http://s33.postimg.org/kd4gvx1lb/hello_api.jpg)



[![Hello-API](https://img.shields.io/badge/Status-Awesome-brightgreen.svg)](https://github.com/Mahmoudz/Hello-API)
[![Build Status](https://travis-ci.org/Mahmoudz/Hello-API.svg?branch=master)](https://travis-ci.org/Mahmoudz/Hello-API)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Mahmoudz/Hello-API/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Mahmoudz/Hello-API/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Mahmoudz/Hello-API/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Mahmoudz/Hello-API/build-status/master)
[![Dependency Status](https://www.versioneye.com/user/projects/578988f4c3d40f0046852116/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/578988f4c3d40f0046852116)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/Mahmoudz/Hello-API/master/LICENSE)



#### The `Hello World` of an API : )

## Content

* [Introduction](#Introduction)
* [Features](#Features)
* [Documentation](#Documentation)
* [Technologies](#Technologies)
* [Contribution](#Contribution)
* [Credits](#Credits)
* [License](#License)

> If you used **Hello API** before `21 June 2016` you may need to check the branch [0.1](https://github.com/Mahmoudz/Hello-API/tree/release-0.1).


<a name="Introduction"></a>
### What is Hello API

Hello API is a **Starter** providing everything to build a modern API-Centric application, with **PHP** and **Laravel 5.2**.

It gives all the common functionalities of a modern API, to help building API-Centric Apps faster.

It uses the best framework, packages, tools and conventions. All configured to work together in a beautiful piece of code.

Setting up an API from scratch takes a lot of time, even with the existence of the many great Technologies and Tools. Hello API saves you time.


### Why API-Centric Apps

Web developers are used to serve HTML pages directly from the Backend. However, this traditional method has many disadvantages in nowadays.

Today we’re living in a digital era, where almost everything is connected to the Internet.

Building cross-devices applications is becoming a must. And to do it, you need APIs (Application Programing Interfaces).

API's can serve anything and everything (Mobile Apps, Web Apps, Smart TVs, Smart Watches,...).
As well as, it can be exposed to the world allowing developers to interact with your Application and help growing your business.

API-Centric Apps allows front-end (Web + Mobile) and back-end developers to work on their codes in parallel. After the front-end Apps are ready they get attached to the back-end (API-Centric) code to start functioning. This leads to zero decoupling between the front-end and the back-end code and also removes the dependencies. The API documentation acts as the contract between both sides during the development life cycle of all the Apps.


### Important Note:

The project is currently under heavy development. 
So expect things to change very quickly.
Also note that there's **no stable release** till this date.


<br>

[![forthebadge](http://forthebadge.com/images/badges/ages-12.svg)](http://www.zalt.me)




<a name="Features"></a>
## Features

>The Hello API comes with great features:

- Token Based Authentication (with JWT "JSON Web Tokens").
- API Throttling (Rate Limiting).
- User Endpoints (Login, Logout, Register, List, Update, Delete, Search).
- Functional Tests covering all the existing Endpoints (using PHPUnit).
- Data Caching support (with auto clearing on Create, Update and Delete).
- Query Parameters support out of the box (orderBy, sortedBy, filter, include).
- Full-text search support out of the box (search, searchFields).
- Auto API Documentation generator (using the API Doc JS).
- Authorization system (ACL), to control which consumer can access your API.
- Supports CORS "Cross-Origin Resource Sharing".
- Localization support (multiple langauges via Content-Language header).
- Automatic Data Pagination (meta links to next and previous data).
- Ability to register users by Device ID (Use App first, register later).
- Auto detect and save device type and platform.
- Easy and auto request input validation.
- Type-Casting JSON responses with Transformers.
- Custom Tests Helpers for faster automated testing (using PHPUnit).
- RESTful API (supporting all HTTP verbs).
- Optional support for the JSON API specification v1.0.
- Automatic dates conversion to ISO format in responses.
- Support for JSON with padding (JSONP).
- Scalable, Stateless and Distributable Application on the server.
- Maintainable and scalable Software Architectural Pattern (using Porto).
- Fully Object Oriented Code, implementing the best design patterns.
- Following the PSR-2/PSR-4 coding/autoloading standards.
- Easy to send Emails.
- Easy to support payment gateways (Ready for Stripe and Paypal).
- Runs on PHP 5.5.9+ (including PHP 7 and HHVM).
- Fully detailed documentation.
- 100% customizable and Open Code.


<a name="Documentation"></a>
## Full Documentation

**Hello API** is architectured using the **Porto** Software Architectural Pattern. 
Thus you MUST read its [Readme](https://github.com/Mahmoudz/Porto) page before getting started, to get an overview of how the code is architectured.

* **Setup:**
	* [Requirements](https://hello-api.readme.io/docs/requirements)
	* [Installation](https://hello-api.readme.io/docs/installation)
	* [Development Workflow](https://hello-api.readme.io/docs/development-workflow)
* **General:**
	* [Supported Parameters](https://hello-api.readme.io/docs/supported-parameters)
	* [Requests & Responses](https://hello-api.readme.io/docs/requests-and-responses)
	* [API Documentation Generator](https://hello-api.readme.io/docs/api-documentation-generator)
	* [Localization](https://hello-api.readme.io/docs/localization)
	* [Tests Helpers](https://hello-api.readme.io/docs/tests-helpers)
	* [Mails](https://hello-api.readme.io/docs/mails)
	* [Payments](https://hello-api.readme.io/docs/payments)
	* [Frequently Asked Questions](https://hello-api.readme.io/docs/faq)
	* [Contribute to Hello API](https://hello-api.readme.io/v5.1.0/docs/contribute-to-hello-api)
* **Components:**
	* [Routes](https://hello-api.readme.io/docs/routes)
	* [Controllers](https://hello-api.readme.io/docs/controllers)
	* [Actions](https://hello-api.readme.io/docs/actions)
	* [Services](https://hello-api.readme.io/docs/services)
	* [Models](https://hello-api.readme.io/docs/models)
	* [Views](https://hello-api.readme.io/docs/views)
	* [Providers](https://hello-api.readme.io/docs/providers)
	* [Requests](https://hello-api.readme.io/docs/requests)
	* [Repositories](https://hello-api.readme.io/docs/repositories)
	* [Criterias](https://hello-api.readme.io/docs/criterias)
	* [Tests](https://hello-api.readme.io/docs/tests)
	* [Exceptions](https://hello-api.readme.io/docs/exceptions)
	* [Migrations](https://hello-api.readme.io/docs/migrations)
	* [Transformers](https://hello-api.readme.io/docs/transformers)
	* [Events](https://hello-api.readme.io/docs/events)
	* [Middlewares](https://hello-api.readme.io/docs/middlewares)
	* [Policies](https://hello-api.readme.io/docs/policies)
	* [Factories](https://hello-api.readme.io/docs/factories)
	* [Seeders](https://hello-api.readme.io/docs/seeders)







<a name="Technologies"></a>
## Technologies

>Hello API is built with the latest & hottest Technologies:

* PHP (Server-Side Scripting Language)
* [Laravel 5.2](http://laravel.com) (PHP Framework)
* [PHPUnit](https://phpunit.de/) (PHP Testing Framework)
* [MySQL](https://www.mysql.com/) (RDBMS Database)
* [Redis](http://redis.io/) (Cache System)
* [API Doc JS](http://apidocjs.com/) (API Documentation Generator)
* Third Party Packages:
	* [Dingo API](https://github.com/dingo/api) (A RESTful API package)
	* [JWT](https://github.com/tymondesigns/jwt-auth) (JSON Web Token Authentication)
	* [CORS](https://github.com/barryvdh/laravel-cors) (Cross-Origin Resource Sharing headers support)
	* [Repository](https://github.com/andersao/l5-repository) (Repositories to abstract the database layer)
	* [Entrust](https://github.com/Zizaco/entrust) (Role-based Permissions)
	* [Guzzle](http://docs.guzzlephp.org/en/latest/) (PHP HTTP client)
	* [Predis](https://packagist.org/packages/predis/predis) (PHP client library for Redis)
	* [Stripe Laravel](https://github.com/cartalyst/stripe-laravel) (Stripe API client)
	* [Laravel Paypal Payment](https://github.com/anouarabdsslm/laravel-paypalpayment) (Paypal API client)
	* [Agent](https://github.com/jenssegers/agent) (Detect users agent)



<br>

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/1bdf99d7-13b1-46ca-8576-c6a702f9afd7/big.png)](https://insight.sensiolabs.com/projects/1bdf99d7-13b1-46ca-8576-c6a702f9afd7)


<a name="Contribution"></a>
## Contribution
Just do it. You are welcome :)





<a name="Credits"></a>
## Credits

| Authors                | Follow on Twitter                                 | Ask for Help                                                                                                          | Hire            |
|------------------------|---------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------|-----------------|
| Mahmoud Zalt (Creator) | [@Mahmoud_Zalt](https://twitter.com/Mahmoud_Zalt) | [![Get help on Codementor](https://cdn.codementor.io/badges/get_help_github.svg)](https://www.codementor.io/mahmoudz) | mahmoud@zalt.me |


<a name="License"></a>
## License

The MIT License [(MIT)](https://github.com/Mahmoudz/Hello-API/blob/master/LICENSE).







