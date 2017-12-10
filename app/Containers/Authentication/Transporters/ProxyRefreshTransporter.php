<?php

namespace App\Containers\Authentication\Transporters;

use App\Ship\Parents\Transporters\Transporter;

/**
 * Class ProxyRefreshTransporter
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ProxyRefreshTransporter extends Transporter
{

    /**
     * @var array
     */
    protected $schema = [
        'properties' => [
            'refresh_token',
            'client_id',
            'client_password',
            'grant_type',
            'scope',
        ],
        'required'   => [
            'refresh_token',
            'client_id',
            'client_password',
        ],
        'default'    => [
            'scope' => '',
        ]
    ];
}
