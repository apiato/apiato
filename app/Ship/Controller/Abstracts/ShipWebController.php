<?php

namespace App\Ship\Controller\Abstracts;

use App\Ship\Controller\Contracts\WebControllerInterface;

/**
 * Class ShipWebController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ShipWebController extends ShipController implements WebControllerInterface
{

    /**
     * ShipWebController constructor.
     */
    public function __construct()
    {

    }

}
