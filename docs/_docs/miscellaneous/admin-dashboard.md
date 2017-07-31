---
title: "Admin Dashboard"
category: "Miscellaneous"
order: 3
---

*APIATO doesn't recommend serving HTML pages. Instead you should build your own Frontend App completely isolated from the Backend code.*

## The provided Admin route:

- http://apiato.dev/admin/dashboard

- http://apiato.dev/admin/login

- http://apiato.dev/admin/logout

- http://apiato.dev/admin/environments (part of the environment editor feature)

## How it works:

Visiting `http://apiato.dev/admin/dashboard` will redirect you to a login page for admins.

the default credentials are:

- email: **admin@admin.com**

- password: **admin**

## Change default Admin credentials:

you can change these default values from the seeder class in the Authorization container: `app/Containers/Authorization/Data/Seeders/RolesAndPermissionsSeeder.php`.
