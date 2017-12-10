<?php

namespace App\Containers\Stripe\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class CreateStripeAccountAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeAccountAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  mixed
     */
    public function run(DataTransporter $data)
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
