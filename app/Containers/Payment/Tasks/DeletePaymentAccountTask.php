<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Data\Repositories\PaymentAccountRepository;
use App\Containers\Payment\Models\PaymentAccount;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class DeletePaymentAccountTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class DeletePaymentAccountTask extends Task
{

    protected $repository;

    public function __construct(PaymentAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(PaymentAccount $account)
    {
        try {
            // first, get the associated account and remove this one!
            $account->accountable->delete();

            // then remove the payment account
            return $this->repository->delete($account->id);
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
