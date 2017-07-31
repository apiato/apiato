<?php

/**
 * @apiDefine UserSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
   "data":{
      "object":"User",
      "id":eqwja3vw94kzmxr0,
      "name":"Mahmoud Zalt",
      "email":"x.rolllln@hotmail.com",
      "confirmed":"0",
      "created_at":{
         "date":"2017-06-06 05:40:51.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "updated_at":{
         "date":"2017-06-06 05:40:51.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "readable_created_at":"1 second ago",
      "readable_updated_at":"1 second ago",
      "roles":{
         "data":[
            {
               "object": "Role",
               "id": abcderf,
               "name":"admin",
               "description":"Super Administrator",
               "display_name":""
            },
            {
               "object": "Role",
               "id": ascderf,
               "name":"client",
               "description":"Special Client!",
               "display_name":""
            }
         ]
      }
   },
   "meta":{
      "include":[
         "stores",
         "invoices",
      ],
      "custom":[

      ]
   }
}
 */

