<?php

namespace App\Containers\Authentication\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

/**
 * Class ProxyApiLoginTransporter
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ProxyApiLoginTransporter extends Transporter
{
    protected $schema = [
        'type' => 'object',
        'properties' => [
            'password',
            'client_id',
            'client_password',
            'grant_type',
            'scope',
            // allow for undefined properties
            'additionalProperties' => true,
        ],
        'required' => [
            'password',
        ],
        'default' => [
            'grant_type' => 'password',
            'scope' => '',
        ]
    ];
}
