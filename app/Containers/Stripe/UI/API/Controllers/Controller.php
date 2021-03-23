<?php

namespace App\Containers\Stripe\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Stripe\UI\API\Requests\CreateStripeAccountRequest;
use App\Containers\Stripe\UI\API\Requests\UpdateStripeAccountRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function createStripeAccount(CreateStripeAccountRequest $request): JsonResponse
    {
        $stripeAccount = Apiato::call('Stripe@CreateStripeAccountAction', [$request]);

        return $this->accepted([
            'message'           => 'Stripe account created successfully.',
            'stripe_account_id' => $stripeAccount->id,
        ]);
    }

    public function updateStripeAccount(UpdateStripeAccountRequest $request): JsonResponse
    {
        $stripeAccount = Apiato::call('Stripe@UpdateStripeAccountAction', [$request]);

        return $this->accepted([
            'message'           => 'Stripe account updated successfully.',
            'stripe_account_id' => $stripeAccount->id,
        ]);
    }
}
