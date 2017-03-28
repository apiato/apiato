---
title: "Queues"
category: "Features"
order: 40
---

Queues work normally as they would in Laravel ([docs](https://laravel.com/docs/queues)). The only difference here is that apiato, by default detect which queue driver you are planning to use, and it's a `database` driver it will create your table migrations (refer to `app/Ship/Features/Migrations/Queue/` folder for more details). 



*More queue support and features are coming to apiato in the future releases.*
