<?php

/**
 * @apiDefine UserSuccessSingleResponse
 *
 * @apiSuccess {Object[]}   data
 * @apiSuccess {String}     data.object
 * @apiSuccess {String}     data.id
 * @apiSuccess {String}     data.name
 * @apiSuccess {String}     data.email
 * @apiSuccess {String}     data.email_verified_at
 * @apiSuccess {String}     data.gender
 * @apiSuccess {String}     data.birth
 * @apiSuccess {Integer}    data.real_id (only for admin)
 * @apiSuccess {String}     data.created_at (only for admin)
 * @apiSuccess {String}     data.updated_at (only for admin)
 * @apiSuccess {String}     data.readable_created_at (only for admin)
 * @apiSuccess {String}     data.readable_updated_at (only for admin)
 *
 * @apiQuery {String}  [include]
 *
 * @apiSuccessExample {json} Success-Response:
 * HTTP/h2 200 OK
 * {
 * "data": {
 * "object": "User",
 * "id": "qmv7dk48x5b690wx",
 * "name": "Frodo Baggins",
 * "email": "lord@ofthe.rings",
 * "email_verified_at": "2023-04-07T11:51:26.000000Z",
 * "gender": "male",
 * "birth": "2023-04-07T11:51:26.000000Z",
 * "real_id": 2,
 * "created_at": "2023-04-07T11:51:26.000000Z",
 * "updated_at": "2023-04-07T11:51:26.000000Z",
 * "readable_created_at": "1 second ago",
 * "readable_updated_at": "1 second ago",
 * },
 * "meta": {
 * "include": [
 * "roles",
 * "permissions",
 * ],
 * "custom": []
 * }
 * }
 */

/**
 * @apiDefine UserSuccessMultipleResponse
 *
 * @apiQuery {String} [include]
 *
 * @apiSuccessExample {json} Success-Response:
 * HTTP/h2 200 OK
 * {
 * "data": [
 * {
 * "object": "User",
 * "id": "qmv7dk48x5b690wx",
 * "name": "Frodo Baggins",
 * "email": "lord@ofthe.rings",
 * "email_verified_at": "2023-04-07T11:51:26.000000Z",
 * "gender": "male",
 * "birth": "2023-04-07T11:51:26.000000Z",
 * "real_id": 1,
 * "created_at": "2023-04-07T11:51:26.000000Z",
 * "updated_at": "2023-04-07T11:51:26.000000Z",
 * "readable_created_at": "1 second ago",
 * "readable_updated_at": "1 second ago",
 * },
 * {
 * "object": "User",
 * "id": "qmv7dk48x5b690wx",
 * "name": "Cruz Harris",
 * "email": "kelvin94@example.com",
 * "email_verified_at": "2023-04-07T11:51:26.000000Z",
 * "gender": "male",
 * "birth": "2023-04-07T11:51:26.000000Z",
 * "real_id": 2,
 * "created_at": "2023-04-07T11:51:26.000000Z",
 * "updated_at": "2023-04-07T11:51:26.000000Z",
 * "readable_created_at": "1 second ago",
 * "readable_updated_at": "1 second ago",
 * },
 * {
 * "object": "User",
 * "id": "bml0wd39b5pkznag",
 * "name": "Dr. Jerome Kris MD",
 * "email": "grady.lauren@example.com",
 * "email_verified_at": "2023-04-07T11:51:26.000000Z",
 * "gender": "male",
 * "birth": "2023-04-07T11:51:26.000000Z",
 * "real_id": 3,
 * "created_at": "2023-04-07T11:51:26.000000Z",
 * "updated_at": "2023-04-07T11:51:26.000000Z",
 * "readable_created_at": "1 second ago",
 * "readable_updated_at": "1 second ago",
 * },
 * {
 * "object": "User",
 * "id": "eq6am74064z0vpbn",
 * "name": "Dr. Saul Beahan",
 * "email": "myrtis21@yahoo.com",
 * "email_verified_at": "2023-04-07T11:51:26.000000Z",
 * "gender": "male",
 * "birth": "2023-04-07T11:51:26.000000Z",
 * "real_id": 4,
 * "created_at": "2023-04-07T11:51:26.000000Z",
 * "updated_at": "2023-04-07T11:51:26.000000Z",
 * "readable_created_at": "1 second ago",
 * "readable_updated_at": "1 second ago",
 * },
 * ],
 * "meta": {
 * "include": [
 * "projects",
 * "organizations",
 * "roles",
 * "modules"
 * ],
 * "custom": [],
 * "pagination": {
 * "total": 5,
 * "count": 5,
 * "per_page": 10,
 * "current_page": 1,
 * "total_pages": 1,
 * "links": {}
 * }
 * }
 * }
 */
