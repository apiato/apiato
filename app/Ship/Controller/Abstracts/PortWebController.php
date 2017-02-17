<?php

namespace App\Ship\Controller\Abstracts;

use App\Ship\Controller\Contracts\WebControllerInterface;

/**
 * Class PortWebController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class PortWebController extends PortController implements WebControllerInterface
{

    /**
     * PortWebController constructor.
     */
    public function __construct()
    {

    }

}
