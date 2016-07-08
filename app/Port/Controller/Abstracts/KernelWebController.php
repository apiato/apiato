<?php

namespace App\Port\Controller\Abstracts;

use App\Port\Butler\Portals\KernelButler;
use App\Port\Controller\Contracts\WebControllerInterface;
use App\Port\Views\Traits\ViewsTrait;
use Illuminate\View\Factory as View;

/**
 * Class KernelWebController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class KernelWebController extends KernelController implements WebControllerInterface
{

    use ViewsTrait;

    /**
     * WebController constructor.
     *
     * @param \Illuminate\View\Factory                                     $view
     * @param \App\Port\Butler\Portals\KernelButler $containersConfig
     */
    public function __construct(View $view, KernelButler $containersConfig)
    {
        $this->loadContainersViewsDirectories($view, $containersConfig);
    }

}
