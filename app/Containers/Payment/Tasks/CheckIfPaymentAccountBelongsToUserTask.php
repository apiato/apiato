<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Exceptions\PaymentAccountDoesNotBelongToUserException;
use App\Containers\Payment\Models\PaymentAccount;
use App\Containers\Payment\Contracts\ChargeableInterface;
use App\Ship\Parents\Tasks\Task;

/**
 * Class CheckIfPaymentAccountBelongsToUserTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class CheckIfPaymentAccountBelongsToUserTask extends Task
{

    /**
     * @param \ChargeableInterface                         $user
     * @param \App\Containers\Payment\Models\PaymentAccount $account
     *
     * @return bool
     * @throws PaymentAccountDoesNotBelongToUserException
     */
    public function run(ChargeableInterface $user, PaymentAccount $account): bool
    {
        if ($user->id !== $account->chargeable->id) {
            throw new PaymentAccountDoesNotBelongToUserException();
        }

        return true;
    }
}
