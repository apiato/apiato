<?php

namespace App\Containers\Payment\Actions;

use App\Containers\Authentication\Tasks\FindAuthenticatedUserTask;
use App\Containers\Payment\Tasks\GetAllPaymentAccountsTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class GetAllPaymentAccountsAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetAllPaymentAccountsAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $user = $this->call(FindAuthenticatedUserTask::class);

        $paymentAccounts = $this->call(GetAllPaymentAccountsTask::class, [], ['ordered', ['filterByUser' => [$user]]]);

        return $paymentAccounts;
    }
}
