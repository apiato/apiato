<?php

namespace App\Containers\Payment\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class PaymentAccountRepository
 */
class PaymentAccountRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'    => '=',
        'name'  => 'like',
    ];

}
