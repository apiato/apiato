<?php

namespace App\Containers\Stripe\Tasks;

use App\Containers\Stripe\Data\Repositories\StripeAccountRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateStripeAccountTask extends Task
{
    private $repository;

    public function __construct(StripeAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        }
        catch(Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
