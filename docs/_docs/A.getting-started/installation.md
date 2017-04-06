---
title: "Installation"
category: "Getting Started"
order: 4
---


## 1) Development Environment Setup

You can run **apiato** on your favorite environment. Below you'll see how you can run it on top of [Vagrant](https://www.vagrantup.com/) (using [Laravel Homestead](https://laravel.com/docs/master/homestead)) or [Docker](https://www.docker.com/) (using [Laradock](https://github.com/Laradock/laradock)). 
We'll see how to use both tools and you can pick one, or you can use other options like [Larvel Valet](https://laravel.com/docs/valet), [Laragon](https://laragon.org/) or even run it directly on your machine.

### Option A: Using Docker (with Laradock):

**Laradock** is a Docker PHP development environment. It facilitate running PHP Apps on Docker.

1) Install [Laradock](https://github.com/LaraDock/laradock#installation).

2) Navigate into the `laradock` directory:

```shell
cd laradock
```
This directory contains a `docker-compose.yml` file. (From the LaraDock project).

3) Run the Docker containers:

```shell
docker-compose up -d nginx mysql redis beanstalkd
```

4) Make sure you are setting the `Docker IP` as `Host` for the `DB` and `Redis`  in your `.env` file.

5) Add the domain to the Hosts file:

5.1) Open the hosts file on your local machine `/etc/hosts`.

*We'll be using `apiato.dev` as local domain (you can change it if you want).*

5.2) Map the domain and its subdomains to 127.0.0.1:

```text
127.0.0.1  apiato.dev
127.0.0.1  api.apiato.dev
127.0.0.1  admin.apiato.dev
```

6. Visit `http://apiato.dev`, `http://api.apiato.dev/v1` and `http://admin.apiato.dev` in your browser.

### Option B: Using Vagrant (with Laravel Homestead):

1) Configure Homestead:

1.1) Open the Homestead config file:

```shell
homestead edit
```

1.2) Map the `api.apiato.dev` domain to the project public directory - Example:

```text
sites:
	- map: api.apiato.dev
  	  to: /{full-path-to}/apiato/public
```

1.3) You can also map other domains like `apiato.dev` and `admin.apiato.dev` to the user web apps:

```text
	- map: apiato.dev
  	  to: /{full-path-to}/apiato/clients/web/user
	- map: admin.apiato.dev
  	  to: /{full-path-to}/apiato/clients/web/admin
```

2) Add the domain to the Hosts file:

2.1) Open the hosts file on your local machine `/etc/hosts`.

*We'll be using `apiato.dev` as local domain (you can change it if you want).*

2.2) Map the domain and its subdomains to the Vagrant IP Address:

```text
192.168.10.10   apiato.dev
192.168.10.10   api.apiato.dev
192.168.10.10   admin.apiato.dev
```

2.3) Run the Virtual Machine:

```shell
homestead up --provision
```

3. Visit `http://apiato.dev`, `http://api.apiato.dev/v1` and `http://admin.apiato.dev` in your browser.

If you see `No input file specified` on the subdomains! try running this command `homestead halt && homestead up --provision`.






## 2) Application Setup

**apiato** can be installed automatically with Composer (recommended) or manually (with Git or direct download):

### A) Install apiato automatically via Composer:

1) Clone the repo, install dependencies and setup the project:

```shell
composer create-project apiato/apiato api
```

2) Edit your `.env` variables to match with your environment (Set Database credentials, App URL, ...).

3) Install OAuth 2.0 via Passport by running this command:

```shell
php artisan passport:install
```


### B) Install apiato manually via Git:

1) Clone the repository:

 ```shell
git clone https://github.com/apiato/apiato.git
 ```

2) Install all dependency packages (including Containers dependencies):

```shell
composer install
```

3) Create `.env` file and copy the content of `.env.example` inside it.

```shell
cp .env.example .env
```

*Check all the variables and edit whatever you want.*

4) Generate a random key `APP_KEY`

```shell
php artisan key:generate
```

5) Install OAuth 2.0 via Passport by running this command:

```shell
php artisan passport:install
```

6) delete the `.git` folder from the root directory and initialize your own with `git init`.





## 3) Database Setup

1) Migrate the Database:

b. Run the migration artisan command:

```shell
php artisan migrate
```

2) Seed the database with the artisan command:

```shell
php artisan db:seed
```

**NOTE:** if you are using Laradock, you need to run those commands from the `workspace` Container, you can enter that container by running `docker-compose exec workspace bash` from the Laradock folder.







## 4) API Documentation Setup:

if you are planning to use ApiDoc JS then proceed with this setup, else skip this and use whatever you prefer:

1) Install [ApiDocJs](http://apidocjs.com/) using NPM or any other way:
```shell
npm install
```

2) run `php artisan apiato:documentation`

##### Visit [API Docs Generator](http://apiato.io/C.features/api-docs-generator/) for more details.


<br>

## Testing
1) Open `phpunit.xml` and make sure the environments are correct for your domain.

2) Open your browser and visit the api domain

```text
http://api.apiato.dev
```

You should see a JSON response the message: `Welcome to apiato.`

3) Let's make some HTTP calls to the API:

*To make the calls you can use [Postman](https://www.getpostman.com/), [HTTPIE](https://github.com/jkbrzt/httpie) or any other tool you prefer.*

Let's test the (user registration) endpoint `http://api.apiato.dev/v1/register ` with **cURL**:

```shell
curl -X POST -H "Accept: application/json" -H "Cache-Control: no-cache" -F "email=mahmoud@zalt.me" -F "password=so-secret" -F "name=Mahmoud Zalt" "http://api.apiato.dev/v1/register"
```

You should get response similar to this:

```json
Access-Control-Allow-Origin → ...
Cache-Control → ...
Connection → keep-alive
Content-Language → en
Content-Type → application/json
Date → Wed, 11 Apr 2000 22:55:88 GMT
Server → nginx
Transfer-Encoding → chunked
Vary → Origin
X-Powered-By → PHP/7.7.7
X-RateLimit-Limit → 99
X-RateLimit-Remaining → 99

{
  "data": {
    "object": "User",
    "id": 77,
    "name": "Mahmoud Zalt",
    "email": "apiato@mail.com",
    "confirmed": null,
    "nickname": "Mega",
    "gender": "male",
    "birth": null,
    "social_auth_provider": null,
    "social_id": null,
    "social_avatar": {
      "avatar": null,
      "original": null
    },
    "created_at": {
      "date": "2017-04-05 16:17:26.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "updated_at": {
      "date": "2017-04-05 16:17:26.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "token": {
      "object": "Token",
      "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJ...",
      "token_type": "Bearer",
      "expires_in": "..."
    },
    "roles": {
      "data": []
    }
  }
}
```
 
4) To run the automated tests you can always type:

```shell
phpunit
```


