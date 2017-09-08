---
title: "Requests"
category: "Getting Started"
order: 5
---

## Sending HTTP Request

Certain API calls require you to send data in a particular format as part of the API call. 
By default, all API calls expect input in `JSON` format, however you need to inform the server that you are sending a JSON-formatted payload.

| Header        | Value Sample                        | When to send it                                                              |
|---------------|-------------------------------------|------------------------------------------------------------------------------|
| Accept        | `application/json`                  | MUST be sent with every endpoint.                                            |
| Content-Type  | `application/x-www-form-urlencoded` | MUST be sent when passing Data.                                              |
| Authorization | `Bearer {Access-Token-Here}`        | MUST be sent whenever the endpoint requires (Authenticated User).            |
| If-None-Match | `811b22676b6a4a0489c920073c0df914`  | MAY be sent to indicate a specific **ETag** of an prior Request to this Endpoint. If both ETags match (i.e., are the same) a HTTP 304 (not modified) is returned. |


> Normally you should include the `Accept => application/json` HTTP header when you call a JOSN API.
However, in Apiato you can force your users to send `application/json` by setting `'force-accept-header' => true,` in `app/Ship/Configs/apiato.php` 
Or allow them to skip it by setting the `'force-accept-header' => false,` (By default this is set to false).


## Calling Endpoints

### Calling unprotected endpoint example:

```shell
curl -X POST -H "Accept: application/json" -H "Content-Type: application/x-www-form-urlencoded; -F "email=admin@admin.com" -F "password=admin" -F "=" "http://api.domain.dev/v2/register"
```

### Calling protected endpoint (passing Bearer Token) example:

```shell
curl -X GET -H "Accept: application/json" -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..." -H "http://api.domain.dev/v1/users"
``` 
