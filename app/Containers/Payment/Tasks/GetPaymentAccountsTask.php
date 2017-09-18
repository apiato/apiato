<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Data\Repositories\PaymentAccountRepository;
use App\Containers\User\Models\User;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Criterias\Eloquent\ThisUserCriteria;
use App\Ship\Parents\Tasks\Task;

/**
 * Class GetPaymentAccountsTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetPaymentAccountsTask extends Task
{
    private $repository;

    public function __construct(PaymentAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }

    public function ordered() {
        return $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
    }

    public function filterByUser(User $user) {
        return $this->repository->pushCriteria(new ThisUserCriteria($user->id));
    }
}
