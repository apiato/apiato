<?php

namespace Hello\Modules\Core\Controller\Abstracts;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as LaravelController;

/**
 * Class CoreController.
 *
 * A.K.A (app/Http/Controllers/Controller.php)
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class CoreController extends LaravelController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
