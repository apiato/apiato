<?php

namespace App\Ship\Transporters;

use App\Ship\Parents\Transporters\Transporter;

/**
 * Class DataTransporter
 *
 * @author Johannes Schobel <johannes.schobel@googlemail.com>
 */
class DataTransporter extends Transporter
{
    /*
     * README FIRST and be sure to fully understand this concept!
     * This is the default transporter that is used, if no other one is specified in the REQUEST class itself. This Transporter,
     * in turn, makes no restrictions to the properties; i.e., it allows everything to be written. This may be ok for
     * some use-cases, however, you may also want to create your own, more specifically tailored Transporters.
     */

    /**
     * @var array
     */
    protected $schema = [
        'type' => 'object',
        'properties' => [
            'additionalProperties' => true,
        ],
        'required' => [  // defined Transporter required fields ['first_name', 'last_name'],

        ],
        'default' => [
//            'foo' => 'bar',
        ]
    ];
}
