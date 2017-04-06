---
title: "User Registration"
category: "Features"
order: 4
---

### Register users by credentials (email and passwords)

Call the `http://api.apiato.dev/v1/register` endpoint (you can find it's documentation after generating the API Docs.

Check out the `registerUser` endpoint in the API Routes files.

This will registered new Users and generates Personal Access Tokens and respond with user object and token.


**Registration request:**

```http
curl --request POST \
  --url http://api.apiato.dev/v1/register \
  --header 'accept: application/json' \
  --header 'content-type: application/x-www-form-urlencoded' \
  --data 'email=apiato%40mail.com1&password=password&name=Mahmoud%20Zalt'
```

**Registration response:**

```json
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

Note: By default every registered user will have a Personal Access Token (the Token name is the user Email). All these Access Tokens will be linked to a default Client of type Personal.


### Register users by Social Account

> (Facebook, Twitter, Google..)

Checkout the [Social Authentication](http://apiato.io/C.features/authentication/) Page for how to Sign up with Social Account.
