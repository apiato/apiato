<?php

namespace App\Containers\Stripe\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Stripe\UI\API\Requests\CreateStripeAccountRequest;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class CreateStripeAccountAction extends Action
{
    public function run(CreateStripeAccountRequest $data)
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $sanitizedData = $data->sanitizeInput([
            'customer_id',
            'card_id',
            'card_funding',
            'card_last_digits',
            'card_fingerprint',
            'nickname',
        ]);

        $account = Apiato::call('Stripe@CreateStripeAccountTask', [$sanitizedData]);

        $result = Apiato::call('Payment@AssignPaymentAccountToUserTask', [$account, $user, $sanitizedData['nickname']]);

        return $result;
    }
}
