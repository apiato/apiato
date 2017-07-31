---
title: "Sub Actions"
category: "Main Components"
order: 16
---

### Definition & Principles

Read from the [**Porto SAP Documentation (#Sub-Actions)**](https://github.com/Mahmoudz/Porto#Sub-Actions).

### Rules

- All SubActions MUST extend from `App\Ship\Parents\Actions\SubAction`.

### Folder Structure

```
 - app
    - Containers
        - {container-name}
            - Actions
                - ValidateAddressSubAction.php
                - BuildOrderSubAction.php
                - ...
```

### Code Sample

**ValidateAddressSubAction User Action:**

```php
<?php

namespace App\Containers\Shipment\Actions;

use App\Containers\Recipient\Models\Recipient;
use App\Containers\Recipient\Tasks\UpdateRecipientTask;
use App\Containers\Shipment\Tasks\ValidateAddressWithEasyPostTask;
use App\Containers\Shipment\Tasks\ValidateAddressWithMelissaDataTask;
use App\Ship\Parents\Actions\SubAction;

class ValidateAddressSubAction extends SubAction
{
    public function run(Recipient $recipient)
    {
        $hasValidAddress = true;

        $easyPostResponse = $this->call(ValidateAddressWithEasyPostTask::class, [$recipient]);

        ...
    }
}
```

**Every feature available for Actions, is also available in SubActions.**
