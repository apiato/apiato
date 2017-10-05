<?php

namespace App\Containers\Payment\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class UpdatePaymentAccountAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class UpdatePaymentAccountAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $user = $this->call('Authentication@GetAuthenticatedUserTask');

        $paymentAccountId = $request->getInputByKey('id');
        $paymentAccount = $this->call('Payment@GetPaymentAccountByIdTask', [$paymentAccountId]);

        // check if this account belongs to our user
        $this->call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        $data = $request->sanitizeInput([
            'name'
        ]);

        $paymentAccount = $this->call('Payment@UpdatePaymentAccountTask', [$paymentAccount, $data]);

        return $paymentAccount;
    }
}
