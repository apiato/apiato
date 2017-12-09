<?php

namespace App\Ship\Defaults\Transporters;

use App\Ship\Parents\Transporters\Transporter;

/**
 * Class DefaultTransporter
 *
 * @author Johannes Schobel <johannes.schobel@googlemail.com>
 */
class DefaultTransporter extends Transporter
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
    ];
}