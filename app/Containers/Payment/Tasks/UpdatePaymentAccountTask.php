<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Data\Repositories\PaymentAccountRepository;
use App\Containers\Payment\Models\PaymentAccount;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class UpdatePaymentAccountTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class UpdatePaymentAccountTask extends Task
{
    protected $repository;

    public function __construct(PaymentAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Containers\Payment\Models\PaymentAccount $account
     * @param array                                         $data
     *
     * @return mixed
     * @throws UpdateResourceFailedException
     */
    public function run(PaymentAccount $account, array $data)
    {
        try {
            return $this->repository->update($data, $account->id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
