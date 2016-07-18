<?php

namespace App\Port\Controller\Abstracts;

use App\Port\Controller\Contracts\WebControllerInterface;

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
