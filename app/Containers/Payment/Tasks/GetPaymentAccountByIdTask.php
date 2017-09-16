<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Data\Repositories\PaymentAccountRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetPaymentAccountByIdTask extends Task
{
    private $repository;

    public function __construct(PaymentAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
