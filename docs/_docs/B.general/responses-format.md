---
title: "Responses Format"
category: "General"
order: 2
---

#Responses Payloads:

**Specification: The default format has the following skeleton:**

```json
{
  "data": [
    {
      "id": 100,
      ...
      "relation 1": {
        "data": [
          {
            "id": 11,
			  ...
          }
        ]
      },
      "relation 2": {
        "data": {
          "id": 22,
          ...
          }
        }
      }
    },
    ...
  ],
  "meta": {
    "pagination": {
      "total": 999,
      "count": 999,
      "per_page": 999,
      "current_page": 999,
      "total_pages": 999,
      "links": {
        "next": "http://api.apiato.dev/accounts?page=999"
      }
    }
  }
}
```

**Paginated response:**

When data is paginated the response payload will contain a `meta` description about the pagination.

```json
  "meta": {
    "pagination": {
      "total": 18,
      "count": 10,
      "per_page": 10,
      "current_page": 1,
      "total_pages": 2,
      "links": {
        "next": "http://api.apiato.dev/accounts?page=2"
      }
    }
  }
```

### Error Response format?

**Error Response:**

```json
{
  "message": "error message goes here",
  "status_code": 500,
  "code": 105
}
```

**Validation Error Response:**

```json
{
    "message": "Could not create new user.",
    "status_code": 422,
    "errors": {
    	"username": [
        	"The username field is required."
    	],
        	"password": [
        	"The password field is required."
    	]
	}
}
```

### Response Header example:

```
Cache-Control:private, must-revalidate
Connection:keep-alive
Content-Type:application/json
Date:Tue, 11 Nov 2011 11:11:11 GMT
ETag:"244216122606707c90d40b45d8f85da1"
Server:nginx/1.8.0
Transfer-Encoding:chunked
X-RateLimit-Limit:100
X-RateLimit-Remaining:77
X-RateLimit-Reset:1458641529
```

### Change the Response payload format:

The default response format (specification) is the `DataArray` Fractal Serializer.

To change the default Fractal Serializer open the `.env` file and change the

```
FRACTAL_SERIALIZER=DataArray
```

The Supported Serializers are (`JsonApi`, `DataArray` and `Array`).

Check out the `overrideDefaultFractalSerializer()` inside the `boot()` function of the `src/Services/Core/Framework/Providers/CoreServiceProvider.php` file.

### Need more info!

For more details check out this [link](https://github.com/dingo/api/wiki/Errors-And-Error-Responses)
