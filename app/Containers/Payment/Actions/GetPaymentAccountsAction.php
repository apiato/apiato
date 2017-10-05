<?php

namespace App\Containers\Payment\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class GetPaymentAccountsAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetPaymentAccountsAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $user = $this->call('Authentication@GetAuthenticatedUserTask');

        $paymentAccounts = $this->call('Payment@GetPaymentAccountsTask', [], ['ordered', ['filterByUser' => [$user]]]);

        return $paymentAccounts;
    }
}
