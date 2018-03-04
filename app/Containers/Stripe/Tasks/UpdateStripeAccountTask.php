<?php

namespace App\Containers\Stripe\Tasks;

use App\Containers\Stripe\Data\Repositories\StripeAccountRepository;
use App\Containers\Stripe\Models\StripeAccount;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateStripeAccountTask extends Task
{

    protected $repository;

    public function __construct(StripeAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Containers\Stripe\Models\StripeAccount $account
     * @param array                                       $data
     *
     * @return mixed
     * @throws UpdateResourceFailedException
     */
    public function run(StripeAccount $account, array $data)
    {
        try {
            return $this->repository->update($data, $account->id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
