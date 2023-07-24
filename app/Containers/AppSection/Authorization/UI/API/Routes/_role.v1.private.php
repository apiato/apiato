<?php

/**
 * @apiDefine RoleSuccessSingleResponse
 *
 * @apiSuccess {Object[]}   data
 * @apiSuccess {String}     data.object
 * @apiSuccess {String}     data.id
 * @apiSuccess {String}     data.name
 * @apiSuccess {String}     data.description
 * @apiSuccess {String}     data.display_name
 * @apiSuccess {String}     data.guard_name (only for admin)
 * @apiSuccess {Object}     data.permissions
 * @apiSuccess {Object[]}   data.permissions.data
 * @apiSuccess {Object}     meta
 * @apiSuccess {String[]}   meta.include
 * @apiSuccess {Object[]}   meta.custom
 *
 * @apiQuery {String} [include]
 *
 * @apiSuccessExample {json} Success-Response:
 * HTTP/h2 200 OK
 * {
 * "data": {
 * "object": "Role",
 * "id": "qmv7dk48x5b690wx",
 * "name": "molestiae",
 * "description": "Similique ut voluptatem nihil consequuntur.",
 * "display_name": "sed",
 * "permissions": {
 * "data": []
 * }
 * },
 * "meta": {
 * "include": [
 * "permissions"
 * ],
 * "custom": []
 * }
 * }
 */

/**
 * @apiDefine RoleSuccessMultipleResponse
 *
 * @apiQuery {String} [include]
 *
 * @apiSuccessExample {json} Success-Response:
 * HTTP/h2 200 OK
 * {
 * "data": [
 * {
 * "object": "Role",
 * "id": "qnwmkv5704blag6r",
 * "name": "admin",
 * "description": "Administrator",
 * "display_name": "Administrator Role",
 * "permissions": {
 * "data": []
 * }
 * },
 * {
 * "object": "Role",
 * "id": "qmv7dk48x5b690wx",
 * "name": "totam",
 * "description": "Quae odit enim ipsum ut esse quis explicabo culpa.",
 * "display_name": "quis",
 * "permissions": {
 * "data": []
 * }
 * },
 * {
 * "object": "Role",
 * "id": "bml0wd39b5pkznag",
 * "name": "neque",
 * "description": "Ut sint magni voluptas eum pariatur.",
 * "display_name": "quae",
 * "permissions": {
 * "data": []
 * }
 * },
 * {
 * "object": "Role",
 * "id": "eq6am74064z0vpbn",
 * "name": "facere",
 * "description": "Atque unde sit fugit deleniti id error ea.",
 * "display_name": "id",
 * "permissions": {
 * "data": []
 * }
 * }
 * ],
 * "meta": {
 * "include": [],
 * "custom": [],
 * "pagination": {
 * "total": 4,
 * "count": 4,
 * "per_page": 15,
 * "current_page": 1,
 * "total_pages": 1,
 * "links": {}
 * }
 * }
 * }
 */
