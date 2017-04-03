<?php

namespace App\Ship\Parents\Controllers;

use App\Ship\Engine\Traits\ResponseTrait;

/**
 * Class ApiController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ApiController extends Controller
{

    use ResponseTrait;
}
