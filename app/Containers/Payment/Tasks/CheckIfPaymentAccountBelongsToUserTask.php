<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Exceptions\PaymentAccountDoesNotBelongToUserException;
use App\Containers\Payment\Models\PaymentAccount;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;

/**
 * Class CheckIfPaymentAccountBelongsToUserTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class CheckIfPaymentAccountBelongsToUserTask extends Task
{

    /**
     * @param \App\Containers\User\Models\User              $user
     * @param \App\Containers\Payment\Models\PaymentAccount $account
     *
     * @return bool
     * @throws PaymentAccountDoesNotBelongToUserException
     */
    public function run(User $user, PaymentAccount $account): bool
    {
        if ($user->id !== $account->user_id) {
            throw new PaymentAccountDoesNotBelongToUserException();
        }

        return true;
    }
}
