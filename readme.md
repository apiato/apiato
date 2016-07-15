# Hello API


[![forthebadge](http://forthebadge.com/images/badges/ages-12.svg)](http://www.zalt.me)


#### The `Hello World` of an API : )

[![Build Status](https://travis-ci.org/Mahmoudz/Hello-API.svg?branch=master)](https://travis-ci.org/Mahmoudz/Hello-API)



> If you used **Hello API** before `21 June 2016` you may need to check the branch [0.1](https://github.com/Mahmoudz/Hello-API/tree/release-0.1).

<br>


#### WHAT

Hello API is a **Starter** providing everything to build a modern API-Centric application, with **PHP** and **Laravel**.

#### HOW

Hello API gives all the common functionalities of a modern API, to help building API-Centric Apps faster.

It uses the best framework, packages, tools and conventions. All configured to work together in a beautiful piece of code.

#### WHY

Today we’re living in a digital era, where almost everything is connected to the Internet.

Building cross-devices applications is becoming a must. And to do it, you need APIs (Application Programing Interfaces).

API's can serve anything and everything (Mobile Apps, Web Apps, Smart TVs, Smart Watches,...).
As well as, it can be exposed to the world allowing developers to interact with your Application and help growing your business.

Setting up an API from scratch takes a lot of time, even with the existence of the many great Technologies and Tools. Hello API saves you time.


#### Important Note:

The project is currently under heavy development. 
So expect things to change very quickly.
Also there's no stable release yet.
So use it today on your own responsibility.


![](http://s33.postimg.org/kd4gvx1lb/hello_api.jpg)



## Content

* [Features](#Features)
* [Technologies](#Technologies)
* [Full Documentation](#Documentation)
* [Coming Features](#Coming-Features)



<a name="Features"></a>
## Features

>The Hello API comes with great features:

- Token Based Authentication (with JWT "JSON Web Tokens").
- API Throttling (Rate Limiting).
- User Endpoints (Login, Logout, Register, List, Update, Delete, Search).
- Functional Tests covering all the existing Endpoints (using PHPUnit).
- Data Caching support (with auto clearing on Create, Update and Delete).
- Useful Query Parameters support out of the box (orderBy, sortedBy, filter, include).
- Full-text search support out of the box (search, searchFields).
- Auto API Documentation generator (using the API Doc JS).
- Authorization system (ACL), to control which consumer can access your API.
- Supports CORS "Cross-Origin Resource Sharing".
- Localization support (multiple langauges via Content-Language header).
- Automatic Data Pagination (meta links to next and previous data).
- Easy and auto request input validation.
- Type-Casting JSON responses with Transformers.
- Custom Tests Helpers for faster automated testing (using PHPUnit).
- RESTful API (supporting all HTTP verbs).
- Optional support for the JSON API specification v1.0.
- Automatic dates conversion to ISO format in responses.
- Support for JSON with padding (JSONP).
- Scalable, Stateless and Distributable Application on the server.
- Modern Software Architectural Pattern (using Porto).
- Fully Object Oriented Code, implementing the best design patterns and coding techniques.
- Following the PSR-2/PSR-4 coding/autoloading standards.
- Easy to send Emails.
- Easy to support payment gateways (Ready for Stripe and Paypal).
- Runs on PHP 5.5.9+ (including PHP 7 and HHVM).
- Full detailed documentation.
- 100% customizable and Open Code.






<a name="Technologies"></a>
## Technologies

>Hello API is built with the latest & hottest Technologies:

- PHP (Server-Side Scripting Language)
* [PHPUnit](https://phpunit.de/) (PHP Testing Framework)
* [MySQL](https://www.mysql.com/) (RDBMS Database)
* [Redis](http://redis.io/) (Cache System)
* [API Doc JS](http://apidocjs.com/) (API Documentation Generator)
* [Laravel Homestead](https://laravel.com/docs/homestead) (Virtual Server Provisioning via [Vagrant](https://www.vagrantup.com/))
- **Third Party Packages:**
	* [Dingo API](https://github.com/dingo/api) (A RESTful API package)
	* [JWT](https://github.com/tymondesigns/jwt-auth) (JSON Web Token Authentication)
	* [CORS](https://github.com/barryvdh/laravel-cors) (Cross-Origin Resource Sharing headers support)
	* [Repository](https://github.com/andersao/l5-repository) (Repositories to abstract the database layer)
	* [Entrust](https://github.com/Zizaco/entrust) (Role-based Permissions)
	* [Guzzle](http://docs.guzzlephp.org/en/latest/) (PHP HTTP client)
	* [Predis](https://packagist.org/packages/predis/predis) (PHP client library for Redis)
	* [Stripe Laravel](https://github.com/cartalyst/stripe-laravel) (Stripe API client)
	* [Laravel Paypal Payment](https://github.com/anouarabdsslm/laravel-paypalpayment) (Paypal API client)






<a name="Documentation"></a>
## Full Documentation

**Hello API** is architectured using the **Porto** Software Architectural Pattern. 
Thus you MUST read its [Readme Document](https://github.com/Mahmoudz/Porto) before getting started, to get an overview of how the code is architectured.

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
	* [Frequently Asked Questions (FAQ)](https://hello-api.readme.io/docs/faq)
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




## Contribution
Just do it. You are welcome :)






## Credits

| Authors                | Follow on Twitter                                 | Ask for Help                                                                                                          | Hire            |
|------------------------|---------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------|-----------------|
| Mahmoud Zalt (Creator) | [@Mahmoud_Zalt](https://twitter.com/Mahmoud_Zalt) | [![Get help on Codementor](https://cdn.codementor.io/badges/get_help_github.svg)](https://www.codementor.io/mahmoudz) | mahmoud@zalt.me |

## License

The MIT License [(MIT)](https://github.com/Mahmoudz/Hello-API/blob/master/LICENSE).







