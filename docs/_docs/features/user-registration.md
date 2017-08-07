---
title: "User Registration"
category: "Features"
order: 5
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
    "roles": {
      "data": []
    }
  }
}
```

Note: After registration you will have to send another call to `http://api.example.com/v1/oauth/token` in order to get the user access token.


### Register users by Social Account

> (Facebook, Twitter, Google..)

Checkout the [Social Authentication]({{ site.baseurl }}{% link _docs/features/authentication.md %}) Page for how to Sign up with Social Account.
