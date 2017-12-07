<?php

namespace App\Containers\Payment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class DeletePaymentAccountAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class DeletePaymentAccountAction extends Action
{

    /**
     * @param $paymentAccountId
     */
    public function run($paymentAccountId): void
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccount = Apiato::call('Payment@FindPaymentAccountByIdTask', [$paymentAccountId]);

        // check if this account belongs to our user
        Apiato::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        Apiato::call('Payment@DeletePaymentAccountTask', [$paymentAccount]);
    }
}
