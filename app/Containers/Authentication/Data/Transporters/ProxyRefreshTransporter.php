<?php

namespace App\Containers\Authentication\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

/**
 * Class ProxyRefreshTransporter
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ProxyRefreshTransporter extends Transporter
{
    protected $schema = [
        'type' => 'object',
        'properties' => [
            'refresh_token',
            'client_id',
            'client_password',
            'grant_type',
            'scope',
        ],
        'required' => [
        ],
        'default' => [
            'grant_type' => 'refresh_token',
            'scope' => '',
        ]
    ];
}
