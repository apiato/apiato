<?php

namespace App\Containers\Wepay\Data\Repositories;

use App\Containers\Wepay\Models\WepayAccount;
use App\Ship\Parents\Repositories\Repository;

/**
 * Class WepayAccountRepository.
 *
 * @author Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class WepayAccountRepository extends Repository
{

    /**
     * the container name. Must be set when the model has different name than the container
     *
     * @var  string
     */
    protected $container = 'Wepay';

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return WepayAccount::class;
    }
}
