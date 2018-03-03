<?php

namespace App\Containers\Payment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class GetAllPaymentAccountsAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetAllPaymentAccountsAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccounts = Apiato::call('Payment@GetAllPaymentAccountsTask',
            [],
            [
                'addRequestCriteria',
                'ordered',
                ['filterByUser' => [$user]]
            ]
        );

        return $paymentAccounts;
    }
}
