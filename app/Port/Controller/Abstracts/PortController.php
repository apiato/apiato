<?php

namespace App\Port\Controller\Abstracts;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as LaravelController;

/**
 * Class PortController.
 *
 * A.K.A (app/Http/Controllers/Controller.php)
 *
 * You are not allowed to extend from this class directly.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class PortController extends LaravelController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
