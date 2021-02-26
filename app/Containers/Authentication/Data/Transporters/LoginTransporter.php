<?php

namespace App\Containers\Authentication\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

class LoginTransporter extends Transporter
{

    /**
     * @var array
     */
    protected $schema = [
        'type' => 'object',
        'properties' => [
            // enter all properties here
            'password',
            'remember_me' => [
                'type' => 'boolean'
            ],
            // allow for undefined properties
            'additionalProperties' => true,
        ],
        'required' => [
            // define the properties that MUST be set
            'password'
        ],
        'default' => [
            // provide default values for specific properties here
            'remember_me' => false
        ]
    ];
}
