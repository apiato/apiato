<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Data\Repositories\PaymentAccountRepository;
use App\Containers\User\Models\User;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Criterias\Eloquent\ThisUserCriteria;
use App\Ship\Parents\Tasks\Task;

/**
 * Class GetAllPaymentAccountsTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetAllPaymentAccountsTask extends Task
{

    protected $repository;

    /**
     * GetAllPaymentAccountsTask constructor.
     *
     * @param \App\Containers\Payment\Data\Repositories\PaymentAccountRepository $repository
     */
    public function __construct(PaymentAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->repository->paginate();
    }

    /**
     * @return  mixed
     */
    public function ordered()
    {
        return $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
    }

    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return  mixed
     */
    public function filterByUser(User $user)
    {
        return $this->repository->pushCriteria(new ThisUserCriteria($user->id));
    }
}
