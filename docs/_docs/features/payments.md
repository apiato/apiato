---
title: "Payments"
category: "Features"
order: 24
---

Currently the payment Supports `Stripe` only.

## Charge users directly

Same method should be applied to other payment gateways, but for this example we'll be using Stripe.

1. Create Stripe Account Model for the User, by calling the endpoint `/stripes` or manually as follow:


```php
<?php

$user = new User();

$createStripeAccountAction = App::make(CreateStripeAccountAction::class);
$stripeAccount = $createStripeAccountAction->run($user, 'cus_8mBD5S1SoyD4zL', 'card_18Uck6KFvMcBUkvQorbBkYhR', 'credit', '4242', 'WsNM4K8puHbdS2VP'); 
```

2. Charge the user using **Stripe** method (`ChargeWithStripeTask`) task:

```php
<?php

namespace App\Containers\Credit\Actions;

use App\Containers\Credit\Tasks\CreateCreditTask;
use App\Containers\Stripe\Tasks\ChargeWithStripeTask;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;

class PurchaseCreditTypeAction extends Action
{
    public function __construct(
        CreateCreditTask $createCreditTask,
        ChargeWithStripeTask $chargeWithStripeTask
    ) {
        $this->createCreditTask = $createCreditTask;
        $this->chargeWithStripeTask = $chargeWithStripeTask;
    }

    public function run(User $user, $amount, $currency_code = 'USD', $note = null)
    {
        // making the payment
        $stripeResponse = $this->chargeWithStripeTask->run($user, $amount, $currency_code);

        $credit = '...'; // .....

        return $credit;
    }
}
```
	 
## Charge users through the proxy

This allows you to charge the user based on whichever payment method the user has, when you are not sure which one the user has used.

**Usage:** 


```php
<?php

// 1. let's say the user has Stripe account stored in your app. Because he entered his credit card info one day. So a code like this have been already executed in the past, but you are not sure because a user can also use other payment gateways:

$stripeAccount = App::make(CreateStripeAccountObjectTask::class)->run($user, 'cus_8mBD5S1SoyD4zL', 'card_18Uck6KFvMcBUkvQorbBkYhR', 'credit', '4242', 'WsNM4K8puHbdS2VP');

// 2. charge the user using the proxy, when you are not sure which payment methode the user has:

$result = $user->charge(1000, 'USD');

```

	 
Before using this feature you may need to check this class `app/Ship/Payment/Proxies/PaymentsProxy.php`.

## Mocking the real call for Testing:


```php
<?php

// mock the ChargeWithStripeService external API call
$this->mock(ChargeWithStripeService::class)->shouldReceive('charge')->andReturn([
'payment_method' => 'stripe',
'description'    => $payId
]);

// mock the ChargeWithPaypalService external API call
$this->mock(ChargeWithPaypalService::class)->shouldReceive('charge')->andReturn([
'payment_method' => 'paypal',
'description'    => $payId
]); 

```


Checkout the [Tests Helpers]({{ site.baseurl }}{% link _docs/miscellaneous/tests-helpers.md %}) page for about Testing.
