---
title: "Jobs"
category: "Optional Components"
order: 33
---

### Definition

Jobs is a name given to classes that are usually created to be queued (deferred for later).
When a Job class is dispatched, it perform specific job and die.

## Principles

- A Container MAY have more than one Job.

### Rules

- All Jobs MUST extend from `App\Ship\Parents\Jobs\Job`.

### Folder Structure

```
 - app
    - Containers
        - {container-name}
            - Jobs
                - DoSomethingJob.php
                - DoSomethingElseJob.php
```

### Code Samples

**CreateAndValidateAddress with third party `Job`:** 

```php
<?php

namespace App\Containers\Shipment\Jobs;

use App\Port\Job\Abstracts\Job;

class CreateAndValidateAddressJob extends Job
{
    private $recipients;

    public function __construct(array $recipients)
    {
        $this->recipients = $recipients;
    }

    public function handle()
    {
        foreach ($this->recipients as $recipient) {
            // do whatever you like
        }
    }
}
```

Check the parent Job class.


**Usage from `Action`:** 

```php
<?php

// using helper function
dispatch(new CreateAndValidateAddressJob($recipients));

// manually
App::make(\Illuminate\Contracts\Bus\Dispatcher\Dispatcher::class)->dispatch(New StatusChangedJob($object));
```

For more information about the Policies read [this](https://laravel.com/docs/5.3/queues).
