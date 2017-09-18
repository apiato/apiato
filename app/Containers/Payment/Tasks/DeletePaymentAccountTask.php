<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Data\Repositories\PaymentAccountRepository;
use App\Containers\Payment\Models\PaymentAccount;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;

/**
 * Class DeletePaymentAccountTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class DeletePaymentAccountTask extends Task
{

    public function run(PaymentAccount $account)
    {
        $repository = App::make(PaymentAccountRepository::class);

        try {
            // first, get the associated account and remove this one!
            $account->accountable->delete();

            // then remove the payment account
            return $repository->delete($account->id);
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
