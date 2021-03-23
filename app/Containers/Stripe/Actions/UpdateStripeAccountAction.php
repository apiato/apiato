<?php

namespace App\Containers\Stripe\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Stripe\Models\StripeAccount;
use App\Containers\Stripe\UI\API\Requests\UpdateStripeAccountRequest;
use App\Ship\Parents\Actions\Action;

class UpdateStripeAccountAction extends Action
{
    public function run(UpdateStripeAccountRequest $data): StripeAccount
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        // check, if this account does - in fact - belong to our user
        $account = Apiato::call('Stripe@FindStripeAccountByIdTask', [$data->id]);
        $paymentAccount = $account->paymentAccount;
        Apiato::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        // we own this account - so it is safe to update it
        $sanitizedData = $data->sanitizeInput([
            'customer_id',
            'card_id',
            'card_funding',
            'card_last_digits',
            'card_fingerprint',
        ]);

        $account = Apiato::call('Stripe@UpdateStripeAccountTask', [$account, $sanitizedData]);

        return $account;
    }
}
