<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Data\Repositories\PaymentAccountRepository;
use App\Containers\Payment\Models\PaymentAccount;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdatePaymentAccountTask extends Task
{
    private $repository;

    public function __construct(PaymentAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(PaymentAccount $account, array $data)
    {
        try {
            return $this->repository->update($data, $account->id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
