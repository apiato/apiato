# Hello API


[![forthebadge](http://forthebadge.com/images/badges/ages-12.svg)](http://www.zalt.me)


#### The `Hello World` of an API : )

[![Build Status](https://travis-ci.org/Mahmoudz/Hello-API.svg?branch=master)](https://travis-ci.org/Mahmoudz/Hello-API)

Hello API is an **API Starter** providing you everything to build a professional API with **PHP** on top of **Laravel 5.1**.

Today everything needs an API (Mobile Apps, Websites, Internet of Things,...). 
And setting up an API from scratch takes a lot of time, even with the existence of the many great Packages and Tools.

Hello API is a project that gives you all the common functionalities of a professional modern API, to start building your own Application on top of it immediately.
It uses the best framework, packages, tools and conventions. All configured to work together in a beautiful piece of code.



![](http://s33.postimg.org/kd4gvx1lb/hello_api.jpg)



## Content

- [Features](#Features)
- [Technologies](#Technologies)
- [Full Documentation](#Documentation)
- [Comming Features](#Comming-Features)






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
- Automatic Data Pagination (meta links to next and previous data).
- Easy and auto request input validation.
- Type-Casting JSON responses with Transformers.
- Custom Tests Helpers for faster automated testing (using PHPUnit).
- RESTful API (supporting all HTTP verbs).
- Optional support for the JSON API specification v1.0.
- Automatic dates conversion to ISO format in responses.
- Support for JSON with padding (JSONP).
- Scalable, Stateless and Distributable Application on the server.
- Modular Software Architecture (using the Freestyle Architecture).
- Fully Object Oriented Code, implementing the best design patterns and coding techniques.
- Following the PSR-2/PSR-4 coding/autoloading standards.
- Runs on PHP 5.5.9+ (including PHP 7 and HHVM).
- Full detailed documentation.
- 100% customizable and Open Code.






<a name="Technologies"></a>
## Technologies

>Hello API is built with the latest & hottest Technologies:

- PHP (Server-Side Scripting Language)
- [Laravel](https://laravel.com/docs/5.1) 5.1 LTS (Back-End Framework)
- [PHPUnit](https://phpunit.de/) (PHP Testing Framework)
- [MySQL](https://www.mysql.com/) (RDBMS Database)
- [Redis](http://redis.io/) (Cache System)
- [API Doc JS](http://apidocjs.com/) (API Documentation Generator)
- [Laravel Homestead](https://laravel.com/docs/homestead) (Virtual Server Provisioning via [Vagrant](https://www.vagrantup.com/))
- **Third Party Packages:**
	- [Dingo API](https://github.com/dingo/api) (A RESTful API package)
	- [JWT](https://github.com/tymondesigns/jwt-auth) (JSON Web Token Authentication)
	- [CORS](https://github.com/barryvdh/laravel-cors) (Cross-Origin Resource Sharing headers support)
	- [Repository](https://github.com/andersao/l5-repository) (Repositories to abstract the database layer)
	- [Entrust](https://github.com/Zizaco/entrust) (Role-based Permissions)
	- [Guzzle](http://docs.guzzlephp.org/en/latest/) (PHP HTTP client)
	- [Predis](https://packagist.org/packages/predis/predis) (PHP client library for Redis)






<a name="Documentation"></a>
## Full Documentation

**Hello API** comes with a detailed documentation ([wiki](https://github.com/Mahmoudz/Hello-API/wiki)), to help you getting started and modifying the existing code.

* Intro
	* [Introduction](https://github.com/Mahmoudz/Hello-API/wiki/Home#introduction)
	* [Requirements](https://github.com/Mahmoudz/Hello-API/wiki/Home#requirements)
	* [Installation](https://github.com/Mahmoudz/Hello-API/wiki/Home#installation)
* General
	* [Folders Structure](https://github.com/Mahmoudz/Hello-API/wiki/Folders-Structure)
	* [Development Workflow](https://github.com/Mahmoudz/Hello-API/wiki/Development-Workflow)
	* [Frequently Asked Questions (FAQ)](https://github.com/Mahmoudz/Hello-API/wiki/FAQ)
* API
	* [Request & Response](https://github.com/Mahmoudz/Hello-API/wiki/API-Request-and-Response)
	* [Supported Parameters](https://github.com/Mahmoudz/Hello-API/wiki/API-Parameters)
	* [Documentation Generator](https://github.com/Mahmoudz/Hello-API/wiki/API-Doc-Generator)
* Components
	* [Routes](https://github.com/Mahmoudz/Hello-API/wiki/Routes)
	* [Controllers](https://github.com/Mahmoudz/Hello-API/wiki/Controllers)
	* [Models](https://github.com/Mahmoudz/Hello-API/wiki/Models)
	* [Tasks](https://github.com/Mahmoudz/Hello-API/wiki/Tasks)
	* [Service Providers](https://github.com/Mahmoudz/Hello-API/wiki/Service-Providers)
	* [Requests](https://github.com/Mahmoudz/Hello-API/wiki/Requests)
	* [Policies](https://github.com/Mahmoudz/Hello-API/wiki/Policies)
	* [Response Transformers](https://github.com/Mahmoudz/Hello-API/wiki/Response-Transformers)
	* [Repositories](https://github.com/Mahmoudz/Hello-API/wiki/Repositories)
	* [Database Criterias](https://github.com/Mahmoudz/Hello-API/wiki/Database-Criterias)
	* [Database Migrations](https://github.com/Mahmoudz/Hello-API/wiki/Database-Migrations)
	* [Exceptions](https://github.com/Mahmoudz/Hello-API/wiki/Exceptions)
	* [Tests](https://github.com/Mahmoudz/Hello-API/wiki/Tests)
	* [Models Factory](https://github.com/Mahmoudz/Hello-API/wiki/Models-Factory)
	* [Database Seeders](https://github.com/Mahmoudz/Hello-API/wiki/Database-Seeders)




<a name="Comming-Features"></a>
##Comming Features

- Hidden real IDs from the response.
- IP Restriction (to whitelist or blacklist IP's).
- Request size limiting and response rate limiting.
- Automatic Code and Data Backup.
- Admin Panel (For Users Management).
- Support login with social networks (Facebook, Twitter, Github, Google).
- Back-end generators (to generate Modules and components) for faster development.
- A lot more cool stuff in mind, (never stop coding).

> Suggest a feature by opening a new Issue with (`Feature -`) title [here](https://github.com/Mahmoudz/Hello-API/issues).





## Contribution
Just do it. You are welcome :)






## Credits

| Authors                | Follow on Twitter                                 | Ask for Help                                                                                                          | Hire            |
|------------------------|---------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------|-----------------|
| Mahmoud Zalt (Creator) | [@Mahmoud_Zalt](https://twitter.com/Mahmoud_Zalt) | [![Get help on Codementor](https://cdn.codementor.io/badges/get_help_github.svg)](https://www.codementor.io/mahmoudz) | mahmoud@zalt.me |

## License

The MIT License [(MIT)](https://github.com/Mahmoudz/Hello-API/blob/master/LICENSE).







