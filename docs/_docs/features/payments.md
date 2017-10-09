---
title: "Payments"
category: "Features"
order: 24
---

- [Supported Payment Gateway](#available-payment-gateways)
- [How to charge users](#how-it-works)
- [Manage Payment Accounts](#payment-accounts)
- [Payment Gateway Container](#payment-gateway-container)
- [Mocking for Testing](#mocking-the-real-call-for-testing)


<br>
<br>

Apiato provides a `Payment` container that acts as *gateway* for multiple payment providers (`Stripe`, 
`PayPal`...).


<a name="available-payment-gateways"></a>
## Supported Payment Gateways

Currently, APIATO Supports the following payment gateways:

* `Stripe`
* `PayPal`
* `WePay`

If you are missing a payment gateway, you can contribute to enhance the features of Apiato.



<a name="how-it-works"></a>
## How to charge users?

1) Use the `App\Containers\Payment\Traits\ChargeableTrait` on the Model you want to charge. And implement `\App\Containers\Payment\Contracts\ChargeableInterface` Interface. 
The User by default is setup to be chargeable.

2) To charge a user, the user must first create a payment account (Stripe, PayPal, WePay,...). Use the respective endpoints to create those endpoints (`createStripeAccount`, `createWepayAccount`,...). A User may have multiple `PaymentAccount`.

3) Then charge the user as follow `$user->charge($account, $amount);`. By providing the `$account` and the `$amount`.

You can get `$account` from the user as follow `$user->paymentAccounts` this will return a Collection of all the user payments accounts to select one. 

Example: 

```php
// in this example we are selecting a random payment account.
$acccount = $user->paymentAccounts->first();

$amount = 99;

$user->charge($acccount, $amount, 'USD');
```

`$user->paymentAccounts` will return a *generic* `PaymentAccount` to  
transform it to the dedicated payment account (`PaypalAccount`, `StripeAccount`...) You can call the `accountable()` function on the selected payment. See [Polymorphic Relationships](https://laravel.com/docs/5.5/eloquent-relationships#polymorphic-relations)
for more details.





<a name="payment-accounts"></a>
## Manage Payment Accounts

Apiato already provides some generic routes in order to allow users to manage their own `PaymentAccount`:
- `GET /user/paymentaccounts` : Get all available `PaymentAccount`s for the current `User`.
- `GET /user/paymentaccounts/{id}`: Get the details of one specific `PaymentAccount`.
- `PATCH /user/paymentaccounts/{id}`: Update a `PaymentAccount` (this does **not** update the credentials for the corresponding payment gateway).
- `DELETE /user/paymentaccounts/{id}`: Delete a `PaymentAccount` including the payment gateway details (e.g., user credentials for `PayPal`).
- To create payment account use the dedicated endpoint (`createStripeAccount`, `createWepayAccount`,...) provided by the payment gateway container (Stripe, WePay,...). Each payment container has its own endpoint to `create` and `update` account details, since each payment requires different data.



<a name="payment-gateway-container"></a>
## Payment Gateway Container

The `Payment` container acts as generic foundation to "plug in" different containers that interacts with specific payment gateways (e.g., `PayPal`, `Stripe`, ...). This section introduces, how these containers shall be implemented in order to be used via the generic `Payment` container.




<a name="mocking-the-real-call-for-testing"></a>
## Mocking the real payment call for Testing

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



