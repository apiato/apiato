<?php

namespace Hello\Modules\Demo\Controllers\Web;

use Hello\Modules\Core\Controller\Abstracts\WebController;

/**
 * Class DemoController
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class DemoController extends WebController
{
    /**
     * @return  string
     */
    public function handle()
    {
        return view('welcome');
    }
}
