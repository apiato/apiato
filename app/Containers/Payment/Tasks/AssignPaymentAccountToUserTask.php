<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Models\AbstractPaymentAccount;
use App\Containers\Payment\Contracts\ChargeableInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class AssignPaymentAccountToUserTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class AssignPaymentAccountToUserTask extends Task
{

    /**
     * @param \App\Containers\Payment\Models\AbstractPaymentAccount $account
     * @param \App\Containers\Payment\Contracts\ChargeableInterface $user
     * @param string|null                                           $paymentNickName
     *
     * @return  \Illuminate\Database\Eloquent\Model
     * @throws  CreateResourceFailedException
     */
    public function run(AbstractPaymentAccount $account, ChargeableInterface $user, string $paymentNickName = null)
    {
        try {
            return $user->paymentAccounts()->create([
                'name'             => $paymentNickName,
                'accountable_id'   => $account->id,
                'accountable_type' => get_class($account),
            ]);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
