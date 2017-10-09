<?php

namespace App\Containers\Payment\Actions;

use App\Containers\Authentication\Tasks\FindAuthenticatedUserTask;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Payment\Tasks\FindPaymentAccountByIdTask;
use App\Containers\Payment\Tasks\UpdatePaymentAccountTask;
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
        $user = $this->call(FindAuthenticatedUserTask::class);

        $paymentAccountId = $request->getInputByKey('id');
        $paymentAccount = $this->call(FindPaymentAccountByIdTask::class, [$paymentAccountId]);

        // check if this account belongs to our user
        $this->call(CheckIfPaymentAccountBelongsToUserTask::class, [$user, $paymentAccount]);

        $data = $request->sanitizeInput([
            'name'
        ]);

        $paymentAccount = $this->call(UpdatePaymentAccountTask::class, [$paymentAccount, $data]);

        return $paymentAccount;
    }
}
