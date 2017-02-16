## Usage Overview



## **Query Parameters**



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











