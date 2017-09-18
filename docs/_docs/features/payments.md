---
title: "Payments"
category: "Features"
order: 24
---

- [User Model (Chargeable)](#user)
- [Payment Accounts](#payment-accounts)
- [Payment Gateway Container](#payment-gateway-container)
- [Charging Users](#charging-users)
- [Mocking the real call for Testing](#mocking-the-real-call-for-testing)
- [Available Payment Gateway](#available-payment-gateways)

<br>
<br>

APIATO provides a generic `Payment` container that acts as *gateway* for specific Payment Providers (like `Stripe`, 
`PayPal` or others). All payment providers **must** use the provided `Contracts` from this container.

<a name="user"></a>
## User Model (Chargeable)

In APIATO, all entities that implement the `\App\Containers\Payment\Contracts\ChargeableInterface` Interface can be 
charged using a specific payment gateway (e.g., `PayPal`). By default, the `User` model already implements this interface, 
while the corresponding `\App\Containers\Payment\Traits\ChargeableTrait` Trait already provides an implementation for the 
required methods. For basic applications you are already set up and ready to go!

<a name="payment-accounts"></a>
## Payment Accounts

A `User` may have multiple `PaymentAccount`s (e.g., one for `Stripe` and 3 different `PayPal` accounts, ...). These 
accounts can be retrieved via `$user->paymentAccounts()`. This returns a `Collection` of all available accounts. However, 
as `Stripe` and `PayPal` may require you to store different information, this kind of *generic* `PaymentAccount` needs to 
be transformed to its dedicated `PaypalAccount` or `StripeAccount`. You can do this by simply calling the `accountable()` 
method on one `PaymentAccount`. See [Polymorphic Relationships](https://laravel.com/docs/5.5/eloquent-relationships#polymorphic-relations)
for more details on this.

APIATO already provides some generic routes in order to allow users to manage their own `PaymentAccount`s:
- `GET /user/paymentaccounts` : Get all available `PaymentAccount`s for the current `User`.
- `GET /user/paymentaccounts/{id}` : Get the details of one specific `PaymentAccount`.
- `PATCH /user/paymentaccounts/{id}` : Update a `PaymentAccount` (this does **not** update the credentials for the 
   corresponding payment gateway).
- `DELETE /user/paymentaccounts/{id}` : Delete a `PaymentAccount` including the payment gateway details (e.g., user 
   credentials for `PayPal`).

Each container for a Payment Gateway must provide details to `create` and `update` account details (cf. `Stripe` container 
for more details on the implementation!).

<a name="payment-gateway-container"></a>
## Payment Gateway Container

As described before, the `Payment` container acts as kind of generic foundation to "plug in" different containers 
that interact with specific payment gateways (e.g., `PayPal`, `Stripe`, ...). This section introduces, how these 
containers shall be implemented in order to be used via the generic `Payment` container.

### Migration & Data Model
If you need to store some data for your specific payment gateway (e.g., some credit card details, or a username) you 
need to create a migration file. This migration file **must not** contain any user-information as it will be connected 
to the `PaymentAccount` later on.

Next, you need to create a `Model` (and an optional `Repository`) to access the information stored in the database.  In 
order to _connect_ this custom `Payment Gateway Model` to a user (and one of his `PaymentAccount`s), the model **must** 
`extend AbstractPaymentGatewayAccount` from the `Payment` container. This abstract class directly extends the `Model` class 
but implements specific interfaces and uses Traits to connect it to the `PaymentAccount`.

The `Interface` requires you to implement additional methods on your `Account`, like:
* `getPaymentGatewayReadableName()` that outputs the Name of the Payment Gateway in a `human readable` way (e.g., `"PayPal"`)
* `getPaymentGatewaySlug()` that defines a slug for this Payment Gateway that "addresses" this gateway in the `payment`
   config file.
* There are other methods required to be implemented as well - however, they are already defined in the abstract class.

### Routes
Next, one need to define specific routes to manage the created account. E.g., you need to implement a `create` and `update`
method in the controller and handle the processing on your own. However, you don't need to implement specific `read` or 
`delete` methods, as this is handled by the `Payment` container.

### Configuration
In order to "enable" this `PaymentGateway` container, it must be added to the `App\Containers\Payment\Configs\payment.php` 
config file. Simply add a key within the `payment.gateways` for the developed container

> The `key` **must** be the same as the value from the `getPaymentGatewaySlug()` method!

Furthermore, the `payment.gateways.x.charger_task` links to the `Task` in the container that handles the logic to
charge a `User` with this `PaymentGateway`. In the case of the `Stripe` container, this looks like this:

```php
    // ...
    
    'gateways' => [
        'stripe' => [
            'container' => 'Stripe',
            'charge_task' => App\Containers\Stripe\Tasks\ChargeWithStripeTask::class,
        ],
        // other gateways here
    ],
    
    // ...
```

<a name="charging-users"></a>
## Charging Users

The `ChargeableInterface` from `User`s let you charge them by using 2 different methods:
* `charge(PaymentAccount $account, $amount, $currency)` : Charge a specific `PaymentAccount` (which is later resolved 
   to the "specific" account for this payment gateway) with the defined amount. It is automatically checked, if the 
   account to be charged belongs to the current user!
* `purchaseShoppingCart(PaymentAccount $account, ShoppingCart $cart, $currency)` : Charge a specific 
   account with the content of a `ShoppingCart` instance. This calls the `charge(...)` method internally!

Both methods are already implemented in the `ChargeableTrait`. They call, however, a generic `PaymentProxy` that 
distributes to the correct Task that charges the User. This charge is resolved via the `payment` configuration file
in the `Payment` container. See the `payment.gateways.x.charger_task` key for more details (where `x` is the `slug` of 
the `PaymentGateway`).

The `Task` that handles charging the `User` must implement the `PaymentChargerTaskInterface`, where a generic `run()`
method is defined.

<a name="mocking-the-real-call-for-testing"></a>
## Mocking the real call for Testing

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

<a name="available-payment-gateways"></a>
## Available Payment Gateways

Currently, APIATO Supports the following payment gateways:
* `PayPal`
* `Stripe`
* `WePay`

If you are missing a payment gateway, you can contribute to enhance the features of APIATO. Please comply to the 
structure of already existing payment gateways to use the generic `Payment` container. This allows for a flexible
and extensible approach.