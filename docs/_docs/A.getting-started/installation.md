---
title: "Installation"
category: "Getting Started"
order: 4
---

## Application Setup

**apiato** can be installed automatically with Composer (recommended) or manually with Git, in addition to direct download of course:

### A) Install apiato automatically via Composer:

Clone the repo, install dependencies and setup the project:

```shell
composer create-project apiato/apiato apiato
```

**Note:** make sure the `JWT_SECRET` is set in the `.env` file. If it still having the default value `xXxXx` then you have to place it manually.

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

4) Generate some random keys `APP_KEY` and `JWT_SECRET`.

```shell
php artisan key:generate && php artisan jwt:generate
```

**Note:** make sure the `JWT_SECRET` is set in the `.env` file. If it still having the default value `xXxXx` then you have to place it manually.

5) delete the `.git` folder from the root directory and initialize your own with `git init`.

### Development Environment Setup

`apiato` can run on top of [Vagrant](https://www.vagrantup.com/) (using [Laravel Homestead](https://laravel.com/docs/master/homestead)) or [Docker](https://www.docker.com/) (using [Laradock](https://github.com/Laradock/laradock)). We'll see how to use both tools and you can pick whichever you prefer. In addition to those options we will show how to install it natively on your machine.

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

6. Visit `apiato.dev`, `api.apiato.dev` and `admin.apiato.dev` in your browser.

### Option B: Using Vagrant (with Laravel Homestead):

1) Configure Homestead:

1.1) Open the Homestead config file:

```shell
homestead edit
```

1.2) Map the `api.apiato.dev` domain to the project public directory - Example:

```yaml
sites:
	- map: api.apiato.dev
  	  to: /{full-path-to}/apiato/public
```

1.3) You can also map other domains like `apiato.dev` and `admin.apiato.dev` to the user web apps:

```yaml
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

3. Visit `apiato.dev`, `api.apiato.dev` and `admin.apiato.dev` in your browser.

If you see `No input file specified` on the subdomains! try running this command `homestead halt && homestead up --provision`.

### Option C: Natively on you Machine

Coming soon.

### Database Setup

1) Migrate the Database:

b. Run the migration artisan command:

```shell
php artisan migrate
```

2) Seed the database with the artisan command:

```shell
php artisan db:seed
```

**NOTE:** if you are using Laradock, you need to run those commands from the `Workspace` Container, you can enter that container by running `docker-compose exec workspace bash` from the Laradock folder.

### 4) API Documentation Setup:

if you are planning to use ApiDoc JS then proceed with this setup, else skip this and use whatever you prefer:

1) Install [ApiDocJs](http://apidocjs.com/) using NPM or any other way:
```shell
npm install
```

2) run `php artisan apidoc::generate`

##### Visit [API Docs Generator](doc:api-docs-generator) for more details.

### Testing
1) Open `phpunit.xml` and make sure the environments are correct for your domain.

2) Open your browser and visit the api domain

```text
http://api.apiato.dev
```

You should see a JSON response the message: `Welcome to apiato.`

3) Let's make some HTTP calls to the API:

*To make the calls you can use [Postman](https://www.getpostman.com/), [HTTPIE](https://github.com/jkbrzt/httpie) or any other tool you prefer.*

Let's test the (user registration) endpoint `http://api.apiato.dev/register ` with **cURL**:

```shell
curl -X POST -H "Accept: application/json" -H "Cache-Control: no-cache" -F "email=mahmoud@zalt.me" -F "password=so-secret" -F "name=Mahmoud Zalt" "http://api.apiato.dev/register"
```

You should get response similar to this:

```shell
Connection → keep-alive
Content-Language → en
Content-Type → application/json
Date → Sun, 09 Oct 1988 06:13:00 GMT
ETag →"955c4d22992b994f8ab10f9864912d4cd6952390"
Server → nginx
Transfer-Encoding → chunked
Vary → Origin
X-Powered-By → PHP/7.0.9
X-RateLimit-Limit → 100
X-RateLimit-Remaining → 97
X-RateLimit-Reset → 1475993702

{
   "data":{
      "object":"User",
      "id":192,
      "name":"Mahmoud Zalt",
      "email":"mahmoud@zalt.me",
      "confirmed":null,
      "nickname":null,
      "gender":null,
      "birth":null,
      "social_auth_provider":null,
      "social_id":null,
      "social_avatar":{
         "avatar":null,
         "original":null
      },
      "created_at":{
         "date":"2017-03-27 15:31:14.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "updated_at":{
         "date":"2017-03-27 15:31:14.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "token":{
         "object":"token",
         "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
         "access_token":{
            "token_type":"Bearer",
            "time_to_live":{
               "minutes":"43200"
            },
            "expires_in":{
               "date":"2017-04-26 15:31:14.000000",
               "timezone_type":3,
               "timezone":"UTC"
            }
         }
      },
      "roles":{
         "data":[
            {
               "object":"Role",
               "id":3,
               "name":"client",
               "description":"Awesome User",
               "display_name":null,
               "permissions":{
                  "data":[

                  ]
               }
            }
         ]
      }
   }
}
```
 
4) To run the automated tests you can always type:

```shell
phpunit
```

### Use your custom URL

Change the default URL from `apiato.dev` to `awesome.com`

1) open your hosts (`sudo vi ect/hosts`) file and map your domain `awesome.com` to the IP address of your Virtual Host (Docker IP or Vagrant IP) or any host you are using in case you have the tools installed locally on your machine.

2) open the .env file and replace `apiato.dev` with `awesome.com` in `APP_URL`, `APP_FULL_URL` and `API_DOMAIN` *(note the API domain should be api.*)*

3) open `phpunit.xml` and change `API_BASE_URL` from `apiato.dev` to `awesome.com`
