<?php

namespace App\Containers\Demo\Controllers\Web;

use App\Containers\Core\Controller\Abstracts\WebController;

/**
 * Class IndexController
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class IndexController extends WebController
{
    /**
     * @return  string
     */
    public function handle()
    {
        return view('welcome');
    }
}
