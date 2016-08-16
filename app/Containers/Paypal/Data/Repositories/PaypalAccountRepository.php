<?php

namespace App\Containers\Paypal\Data\Repositories;

use App\Containers\Paypal\Models\PaypalAccount;
use App\Port\Repository\Abstracts\Repository;

/**
 * Class PaypalAccountRepository.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class PaypalAccountRepository extends Repository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return PaypalAccount::class;
    }
}
