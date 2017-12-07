<?php

namespace App\Containers\Stripe\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class CreateStripeAccountAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeAccountAction extends Action
{

    /**
     * @param $sanitizeData
     *
     * @return  mixed
     */
    public function run($sanitizeData)
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $account = Apiato::call('Stripe@CreateStripeAccountTask', [$sanitizeData]);

        $result = Apiato::call('Payment@AssignPaymentAccountToUserTask', [$account, $user, $sanitizeData['nickname']]);

        return $result;
    }

}
