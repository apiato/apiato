<?php

namespace App\Ship\Controller\Abstracts;

use App\Ship\Butler\Portals\KernelButler;
use App\Ship\Controller\Contracts\WebControllerInterface;
use App\Ship\Views\Traits\ViewsTrait;
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
     * @param \App\Ship\Butler\Portals\KernelButler $containersConfig
     */
    public function __construct(View $view, KernelButler $containersConfig)
    {
        $this->loadContainersViewsDirectories($view, $containersConfig);
    }

}
