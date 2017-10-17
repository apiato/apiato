---
title: "Requests"
category: "Getting Started"
order: 4
---

* [Form content types](#form-content-types)
* [HTTP Request Headers](#send-http-req)
* [Calling Endpoints](#call-EP)
  * [Calling unprotected endpoint example](#call-unprotected-EP)
  * [Calling protected endpoint (passing Bearer Token) example](#call-protected-EP)


<br>

<a name="form-content-types"></a>
## Form content types (W3C)

By default Apiato is configured to encode simple text/ASCII data `x-www-form-urlencoded`. However, it does support other types as well. 


#### ASCII payload

To tell the web server that you are posting simple text/ASCII payload (`name=Mahmoud+Zalt&age=18`), you need to include `Content-Type = x-www-form-urlencoded` in the request header.

#### JSON payload

To tell the web server that you are posting JSON-formatted payload (`{name : 'Mahmoud Zalt', age: 18}`), you need to include `Content-Type = application/json` in the request header.

*(you may wish return Json data in this case as well, you can do so by changing the response serializer from `DataArraySerializer` to `JsonApiSerializer`, more about that in the response page).*



<a name="send-http-req"></a>
## HTTP Request Headers

| Header        | Value Sample                        | When to send it                                                              |
|---------------|-------------------------------------|------------------------------------------------------------------------------|
| Accept        | `application/json`                  | MUST be sent with every endpoint.                                            |
| Content-Type  | `application/x-www-form-urlencoded` | MUST be sent when passing Data.                                              |
| Authorization | `Bearer {Access-Token-Here}`        | MUST be sent whenever the endpoint requires (Authenticated User).            |
| If-None-Match | `811b22676b6a4a0489c920073c0df914`  | MAY be sent to indicate a specific **ETag** of an prior Request to this Endpoint. If both ETags match (i.e., are the same) a HTTP 304 (not modified) is returned. |


> Normally you should include the `Accept => application/json` HTTP header when you call a JSON API.
However, in Apiato you can force your users to send `application/json` by setting `'force-accept-header' => true,` in `app/Ship/Configs/apiato.php`
Or allow them to skip it by setting the `'force-accept-header' => false,` (By default this is set to false).


<a name="call-EP"></a>
## Calling Endpoints
<a name="call-unprotected-EP"></a>
### Calling unprotected endpoint example:

```shell
curl -X POST -H "Accept: application/json" -H "Content-Type: application/x-www-form-urlencoded; -F "email=admin@admin.com" -F "password=admin" -F "=" "http://api.domain.dev/v2/register"
```
<a name="call-protected-EP"></a>
### Calling protected endpoint (passing Bearer Token) example:

```shell
curl -X GET -H "Accept: application/json" -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..." -H "http://api.domain.dev/v1/users"
```
