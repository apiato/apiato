<?php

namespace App\Containers\Payment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Collection;

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
     * @return  Collection
     */
    public function run(Request $request): Collection
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccounts = Apiato::call('Payment@GetAllPaymentAccountsTask', [],
            ['ordered', ['filterByUser' => [$user]]]);

        return $paymentAccounts;
    }
}
