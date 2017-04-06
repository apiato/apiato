## Usage Overview

Here are some information that should help you understand the basic usage of our RESTful API. 
Including info about authenticating users, making requests, responses, potential errors, rate limiting, pagination, query parameters and more.



## **Headers**

Certain API calls require you to send data in a particular format as part of the API call. 
By default, all API calls expect input in `JSON` format, however you need to inform the server that you are sending a JSON-formatted payload.
And to do that you must include the `Accept => application/json` HTTP header with every call.


| Header        | Value Sample                        | When to send it                                                              |
|---------------|-------------------------------------|------------------------------------------------------------------------------|
| Accept        | `application/json`                  | MUST be sent with every endpoint.                                            |
| Content-Type  | `application/x-www-form-urlencoded` | MUST be sent when passing Data.                                              |
| Authorization | `Bearer {Access-Token-Here}`        | MUST be sent whenever the endpoint requires (Authenticated User).            |



## **Rate limiting**

All REST API requests are throttled to prevent abuse and ensure stability. 
The exact number of calls that your application can make per day varies based on the type of request you are making.

The rate limit window is `{{rate-limit-expires}}` minutes per endpoint, with most individual calls allowing for `{{rate-limit-attempts}}` requests in each window.

*In other words, each user is allowed to make `{{rate-limit-attempts}}` calls per endpoint every `{{rate-limit-expires}}` minutes. (For each unique access token).*


For how many hits you can preform on an endpoint, you can always check the header:

```
X-RateLimit-Limit → 30
X-RateLimit-Remaining → 29
```


## **Tokens**

The Access Token lives for `{{access-token-expires-in}}`. (equivalent to `{{access-token-expires-in-minutes}}` minutes).
While the Refresh Token lives for `{{refresh-token-expires-in}}`. (equivalent to `{{refresh-token-expires-in-minutes}}` minutes).

*You will need to re-autneticate the user when the token expires.*


## **Pagination**

By default, all fetch requests return the first `{{pagination-limit}}` items in the list. Check the **Query Parameters** for how to controll the pagination.


## **Responses**

Unless otherwise specified, all of API endpoints will return the information that you request in the JSON data format.


#### Normal response example

```shell
{
  "data": {
    "object": "Role",
    "id": "owpmaymq",
    "name": "admin",
    "description": "Administrator",
    "display_name": null,
    "permissions": {
      "data": [
        {
          "object": "Permission",
          "id": "wkxmdazl",
          "name": "update-users",
          "description": "Update a User.",
          "display_name": null
        },
        {
          "object": "Permission",
          "id": "qrvzpjzb",
          "name": "delete-users",
          "description": "Delete a User.",
          "display_name": null
        }
      ]
    }
  }
}
```


#### Pagination

*The pagination object is always returned in the **meta** when pagination is available on the endpoint.*

```shell
  "data": [...],
  "meta": {
    "pagination": {
      "total": 2000,
      "count": 30,
      "per_page": 30,
      "current_page": 22,
      "total_pages": 1111,
      "links": {
        "previous": "http://api.domain.dev/endpoint?page=21"
      }
    }
  }
```

#### Header

Header Response :

```
Cache-Control →private, must-revalidate
Connection →keep-alive
Content-Type →application/json
Date →Thu, 14 Feb 2014 22:33:55 GMT
ETag →"9c83bf4cf0d09c34782572727281b85879dd4ff6"
Server →nginx
Transfer-Encoding →chunked
X-Powered-By →PHP/7.0.9
X-RateLimit-Limit →100
X-RateLimit-Remaining →99
X-RateLimit-Reset →1487277532
```



## **Query Parameters**

Query parameters are optional, you can apply them to some endopints whenever you need them.

### Ordering

The `?orderBy=` parameter can be applied to any **`GET`** HTTP request responsible for listing records.


**Usage:**

```
api.domain.dev/endpoint?orderBy=created_at
```



### Sorting

The `?sortedBy=` parameter is usually used with the `orderBy` parameter.

By default the `orderBy` sorts the data in **Ascending** order, if you want the data sorted in **Descending** order, you can add `&sortedBy=desc`.



**Usage:**

```
api.domain.dev/endpoint?orderBy=name&sortedBy=desc
```

Order By Accepts:

- `asc` for Ascending.
- `desc` for Descending.





### Searching

The `?search=` parameter can be applied to any **`GET`** HTTP request.


**Usage:**

#### Search any field:

```
api.domain.dev/endpoint?search=keyword here
```

> Space should be replaced with `%20` (search=keyword%20here).

#### Search any field for multiple keywords:

```
api.domain.dev/endpoint?search=first keyword;second keyword
```

#### Search in specific field:
```
api.domain.dev/endpoint?search=field:keyword here
```

#### Search in specific fields for multiple keywords: 
```
api.domain.dev/endpoint?search=field1:first field keyword;field2:second field keyword
```

#### Define query condition:

```
api.domain.dev/endpoint?search=field:keyword&searchFields=name:like
```

Available Conditions: 

- `like`: string like the field. (SQL query `%keyword%`).
- `=`: string exact match.


#### Define query condition for multiple fields:

```
api.domain.dev/endpoint?search=field1:first keyword;field2:second keyword&searchFields=field1:like;field2:=;
```



### Filtering

The `?orderBy=` parameter can be applied to any **`GET`** HTTP request. And is used to request only certain fields.

**Usage:**

Return only ID and Name from that Model, (everything else will be returned as `null`).

```
api.domain.dev/endpoint?filter=id;name
```


### Paginating

The `?page=` parameter can be applied to any **`GET`** HTTP request responsible for listing records (mainly for Paginated data).

**Usage:**

```
api.domain.dev/endpoint?page=200
```


### Relationships

The `?include=` parameter can be used with any endpoint, only if it supports it. 

How to use it: let's say there's a Driver object and Car object. And there's an endopint `/cars` that returns all the cars objects. 
The include allows getting the cars with their drivers `/cars?include=drivers`. 

However, for this parameter to work, the endpoint `/cars` should clearly define that it
accepts `driver` as relationship (in the **Available Relationships** section).

**Usage:**

```
api.domain.dev/endpoint?include=relationship
```



### Caching

Some endpoints stores their response data in memory (chaching) after quering them for the first time, to speed up the response time.
The `?skipCache=` parameter can be used to force skip loading the response data from the server cache and instead get a fresh data from the database upon the request.

**Usage:**

```
api.domain.dev/endpoint?skipCache=true
```




## **Errors**


General Errors:

| Error Code | Message                                                                               | Reason                                              |
|------------|---------------------------------------------------------------------------------------|-----------------------------------------------------|
| 401        | Wrong number of segments.                                                             | Wrong Token.                                        |
| 401        | Failed to authenticate because of bad credentials or an invalid authorization header. | Missing parts of the Token.                         |
| 401        | Could not decode token: The token ... is an invalid JWS.                              | Missing Token.                                      |
| 405        | Method Not Allowed.                                                                   | Wrong Endpoint URL.                                 |
| 422        | Invalid Input.                                                                        | Validation Error.                                   |
| 500        | Internal Server Error.                                                                | {Report this error as soon as you get it.}          |
| 500        | This action is unauthorized.                                                          | Using wrong HTTP Verb. OR using unauthorized token. |

TO BE CONTINUE...


## **Requests**

Calling unprotected endpoint example:

```shell
curl -X POST -H "Accept: application/json" -H "Content-Type: multipart/form-data; -F "email=admin@admin.com" -F "password=admin" -F "=" "http://api.domain.dev/login"
```

Calling protected endpoint (passing Bearer Token) example:

```shell
curl -X GET -H "Accept: application/json" -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..." -H "http://api.domain.dev/users"
```

