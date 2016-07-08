<?php

namespace App\Port\Controller\Abstracts;

use App\Port\Butler\Portals\PortButler;
use App\Port\Controller\Contracts\WebControllerInterface;
use App\Port\Views\Traits\ViewsTrait;
use Illuminate\View\Factory as View;

/**
 * Class PortWebController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class PortWebController extends PortController implements WebControllerInterface
{

    use ViewsTrait;

    /**
     * WebController constructor.
     *
     * @param \Illuminate\View\Factory                                     $view
     * @param \App\Port\Butler\Portals\PortButler $containersConfig
     */
    public function __construct(View $view, PortButler $containersConfig)
    {
        $this->loadContainersViewsDirectories($view, $containersConfig);
    }

}
