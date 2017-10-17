<?php

namespace App\Containers\Wepay\Tasks;

use App\Containers\Wepay\Exceptions\WepayApiErrorException;
use App\Ship\Parents\Tasks\Task;
use KevinEm\WePay\Laravel\WePayLaravel;
use Exception;
use Illuminate\Support\Facades\Config;

/**
 * Class CreateWepayCustomerTask.
 *
 * @author Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class CreateWepayCustomerTask extends Task
{

    public $wepayLaravel;

    /**
     * WepayApi constructor.
     *
     * @param \KevinEm\WePay\Laravel\WePayLaravel $wepayLaravel
     */
    public function __construct(WePayLaravel $wepayLaravel)
    {
        $this->wepayLaravel = $wepayLaravel->make(
            Config::get('wepay-container.client_secret'),
            Config::get('wepay-container.version')
        );
    }

    /**
     * @param        $email
     * @param string $description
     *
     * @return array Wepay customer object
     * @throws WepayApiErrorException
     */
    public function run($email, $description = '')
    {
        try {

            $response = $this->wepayLaravel->customers()->create([
                'email'       => $email,
                'description' => $description,
            ]);

        } catch (Exception $e) {
            throw (new WepayApiErrorException('Wepay API error (createCustomer)'))->debug($e->getMessage(), true);
        }

        return $response;
    }

}
