# Apiato

<h3 align="center">Build great API's faster | with PHP and laravel 5.5</h3>


<p align="center">
   <img src="https://github.com/apiato/apiato/blob/master/docs/images/apiato-icon.png" alt="Apiato Logo"/>
</p>


[![apiato](https://img.shields.io/badge/Status-Awesome-brightgreen.svg)](https://github.com/apiato/apiato)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/apiato/apiato/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/apiato/apiato/?branch=master)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/ce8fed7f8fcd492ebbe5ef0fb36c0a9a)](https://www.codacy.com/app/mahmoudz/apiato?utm_source=github.com&utm_medium=referral&utm_content=apiato/apiato&utm_campaign=badger)
[![Build Status](https://scrutinizer-ci.com/g/apiato/apiato/badges/build.png?b=master)](https://scrutinizer-ci.com/g/apiato/apiato/build-status/master)
[![Build Status](https://travis-ci.org/apiato/apiato.svg?branch=master)](https://travis-ci.org/apiato/apiato)
[![Latest Stable Version](https://poser.pugx.org/apiato/apiato/v/stable)](https://packagist.org/packages/apiato/apiato)
[![License](https://poser.pugx.org/apiato/apiato/license)](https://packagist.org/packages/apiato/apiato)


<a name="Introduction"></a>


### What is Apiato

**Apiato** is a framework for building scalable and testable API-Centric Applications with PHP.
      
It is designed to help you build scalable API's faster, by providing tools and functionalities that facilitates the development of any API-Centric App.

Apiato uses the best frameworks, tools and conventions in a very creative way, to deliver a rich set of features for a modern PHP Application.

**Why!?** Because setting up a solid API from scratch is time consuming (and of course, time is money!). 
Apiato gives you the core features of robust API's fully documented, for free; so you can focus on writing your business logic, thus deliver faster to your clients.


### Why API-Centric Apps?

Today we’re living in a digital era, where almost everything is connected to the Internet.

Building cross-devices applications is becoming a must. And to do it, you need APIs (Application Programing Interfaces).

Web developers are used to serve HTML pages directly from the Backend. However, this traditional method has many disadvantages nowadays.

API's can serve anything and everything (Mobile Apps, Web Apps, Smart TVs, Smart Watches,...).
As well as, it can be exposed to the world allowing developers to interact with your Application and help growing your business.

API-Centric Apps allows Frontend (Web + Mobile) and Backend developers to work on their codes in parallel. After the Frontend Apps are ready they get attached to the Backend (API-Centric) code to start functioning. This leads to zero decoupling between the Frontend and the Backend code and also removes the dependencies. The API documentation acts as the contract between both sides during the development life cycle of all the Apps.



<a name="Features"></a>
## Features

> Apiato comes with great features:

1. Authentication with OAuth2.0 for first/third-party clients (using Laravel Passport).
2. Role-Based Access Control (RBAC), seeded with a Super Admin, Roles and Permissions. In addition to permissions inheritance with Levels.
3. Query Parameters support (orderBy, sortedBy and filter) with full-text search (search, searchFields).
4. Useful endpoints for managing users, roles/permissions, tokens and more. All implemented, documented and tested.
5. API Documentations generator, to generate API docs from PHP Docblock (using the ApiDocJS tool).
6. Supports CORS (Cross-Origin Resource Sharing) and JSONP (JSON with padding), allowing access from different domians.
7. Auto encoding/decoding of real ID's, to prevent exposing real ID's to the outer world.
8. API Throttling (rate limiting to control the rate of traffic received).
9. Support "include" request parameter to load nested relationships for complex data structures.
10. Support Data Caching (with auto clearing on Create, Update and Delete).
11. API versioning in the URL or Header (versioning based on the route file name).
12. Exception handleing with custom JSON errors responses (using Exceptions Formatters).
13. Support Shallow ETag HTTP Header, to reduce client bandwidth.
14. Localization (easily switch between languages via request header field).
15. Automatic Data Pagination (meta links to the next and previous data).
16. WEB and API Authentication Middlewares. With Proxy endpoints for safer authentication from first-party clients.
17. Http Requests/Response Monitor and DB Query Debugger (from the Debugger Container).
18. Profiler, to display profiling data in the response (using Laravel Debugbar).
19. Social Authentication supported out of the box (Facebook, Twitter, Google+).
20. Type-Casting JSON responses and pagination results with Transformers (using Fractal).
21. Useful Tests Helpers for faster and more enjoyable automated testing (using PHPUnit).
22. Support multiple response payload formats (JSON API specification v1.0, Data Array and pure Data).
23. Automatic dates conversion to ISO format in responses.
24. Support Stripe and WePay payment gateways (extandable to support other payment gatways).
25. System and User level Settings out of the box (by the Settings Container).
26. Easy Validation and Authorization (for User data, accessibility and ownership) with Requests objects.
27. Maintainable and scalable Software Architectural Pattern (using the [Porto SAP](https://github.com/Mahmoudz/Porto)).
28. Code generator commands, for generating full CRUD operations, and other useful Commands.
29. Separation of UI's (Web, API and CLI) components (routes, controllers, requests, tests...).
30. Ready Admin dashboard infrastructure with Login view (admin.apiato.dev).
31. Fully detailed documentation, with code samples, principles, definitions and guidelines. (at [docs.apiato.io](http://docs.apiato.io)).
32. 100% customizable and open code. Using latest and greatest frameworks, tools, packages and standards.
99. Much more...




<a name="Documentation"></a>
## Documentation

[![forthebadge](http://forthebadge.com/images/badges/ages-12.svg)](http://apiato.io)


**Apiato** is built using the new architectural pattern **[Porto](https://github.com/Mahmoudz/Porto)**.
> **Porto SAP** is a modern Software Architectural Pattern, designed to help developers organize their Code in a super maintainable way. It is very helpful for big and long term projects, as they tend to have higher complexity with time.

You are **NOT** forced to build your Application using the Porto architecture.
You can build it using the [MVC](http://docs.apiato.io/getting-started/architecture/#mvc-intro) architecture, and still benifit from all the features that Apiato provides. *(The Apiato MVC version is a little different than the standrd MVC)*. The Apiato features themselves are written using Porto, but can be used by any architecture.

<br>


<p align="center">
	<a href="http://docs.apiato.io/">
	   <img src="https://s19.postimg.org/ecnn9vdw3/Screen_Shot_2017-08-01_at_5.08.54_AM.png" width=250px" alt="Apiato Docs"/>
	</a>
</p>


---


<p align="center">Join our Slack chatting room, by clicking on the icon below.</p>

<p align="center">
	<a href="https://slackin-mezlsumyvc.now.sh/">
	   <img src="https://s19.postimg.org/h7pvzy9ar/Slack-i_OS-icon.png" alt="Apiato SLACK"/>
	</a>
</p>



<a name="Credits"></a>
## Credits

Created by [Mahmoud Zalt](https://zalt.me/) (Twitter [@Mahmoud_Zalt](https://twitter.com/Mahmoud_Zalt)).

And a list of awesome contributors:

- [Johan Alvarez](https://github.com/llstarscreamll)
- [Þorgrímur Jónasarson](https://github.com/toggi737)
- [Johannes Schobel](https://github.com/johannesschobel)
- [FWidm](https://github.com/FWidm)
- [Abdelrhman Soliman](https://github.com/Nasr-Z1)
- [Dan Anderson](https://github.com/droplister)
- [See full list](https://github.com/apiato/apiato/graphs/contributors)
- [Join Us?](http://docs.apiato.io/miscellaneous/contribution/#Contributing-Apiato)


<a name="Donations"></a>
## Donations

Help me keep the project development going, by [contributing](http://docs.apiato.io/miscellaneous/contribution/#Contributing-Apiato) or donating a little.

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/mzalt) 

[![Beerpay](https://beerpay.io/apiato/apiato/badge.svg?style=flat)](https://beerpay.io/apiato/apiato)


<a name="License"></a>
## License

The MIT License [(MIT)](https://github.com/apiato/apiato/blob/master/LICENSE).
