<?php

/**
 * @apiDefine PermissionSuccessSingleResponse
 *
 * @apiSuccess {Object[]}   data
 * @apiSuccess {String}     data.object
 * @apiSuccess {String}     data.id
 * @apiSuccess {String}     data.name
 * @apiSuccess {String}     data.description
 * @apiSuccess {String}     data.display_name
 * @apiSuccess {String}     data.guard_name (only for admin)
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
 * "object": "Permission",
 * "id": "n9kq6345javb05je",
 * "name": "amet-ducimus",
 * "description": null,
 * "display_name": null
 * },
 * "meta": {
 * "include": [],
 * "custom": []
 * }
 * }
 */

/**
 * @apiDefine PermissionSuccessMultipleResponse
 *
 * @apiQuery {String} [include]
 *
 * @apiSuccessExample {json} Success-Response:
 * HTTP/h2 200 OK
 * {
 * "data": [
 * {
 * "object": "Permission",
 * "id": "qnwmkv5704blag6r",
 * "name": "sync-wwf-ff",
 * "description": "Permission for wwf service worker ForestForwards synchronization.",
 * "display_name": null
 * },
 * {
 * "object": "Permission",
 * "id": "qmv7dk48x5b690wx",
 * "name": "manage-roles",
 * "description": "Create, Update, Delete, Get All, Attach/detach permissions to Roles and Get All Permissions.",
 * "display_name": null
 * },
 * {
 * "object": "Permission",
 * "id": "bml0wd39b5pkznag",
 * "name": "create-admins",
 * "description": "Create new Users (Admins) from the dashboard.",
 * "display_name": null
 * },
 * {
 * "object": "Permission",
 * "id": "eq6am74064z0vpbn",
 * "name": "manage-admins-access",
 * "description": "Assign users to Roles.",
 * "display_name": null
 * },
 * {
 * "object": "Permission",
 * "id": "dqb9073ap3ekzgrm",
 * "name": "access-dashboard",
 * "description": "Access the admins dashboard.",
 * "display_name": null
 * },
 * {
 * "object": "Permission",
 * "id": "lnmojg5bv4ew80ra",
 * "name": "search-users",
 * "description": "Find a User in the DB.",
 * "display_name": null
 * },
 * {
 * "object": "Permission",
 * "id": "w6l8b75dy5qkv9ze",
 * "name": "list-users",
 * "description": "Get All Users.",
 * "display_name": null
 * },
 * {
 * "object": "Permission",
 * "id": "ao6grd4ed38kyeqz",
 * "name": "update-users",
 * "description": "Update a User.",
 * "display_name": null
 * },
 * {
 * "object": "Permission",
 * "id": "8ykwxd4gx3ampj9v",
 * "name": "delete-users",
 * "description": "Delete a User.",
 * "display_name": null
 * },
 * {
 * "object": "Permission",
 * "id": "lo9m8d5jd5e07yvx",
 * "name": "refresh-users",
 * "description": "Refresh User data.",
 * "display_name": null
 * },
 * {
 * "object": "Permission",
 * "id": "6rldzq4kg3nea7jp",
 * "name": "nam",
 * "description": "Consequuntur quas vero dolor in expedita quia.",
 * "display_name": "dolorem"
 * },
 * {
 * "object": "Permission",
 * "id": "kpn8rx3le5wamge6",
 * "name": "sint",
 * "description": "Temporibus ducimus nesciunt quaerat odit in.",
 * "display_name": "a"
 * },
 * {
 * "object": "Permission",
 * "id": "v9zdex5mn3kmgyap",
 * "name": "ut",
 * "description": "Odit laboriosam suscipit deserunt.",
 * "display_name": "necessitatibus"
 * }
 * ],
 * "meta": {
 * "include": [],
 * "custom": [],
 * "pagination": {
 * "total": 13,
 * "count": 13,
 * "per_page": 15,
 * "current_page": 1,
 * "total_pages": 1,
 * "links": {}
 * }
 * }
 * }
 */
