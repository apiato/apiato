<?php

namespace App\Ship\Parents\Controllers;

use App\Ship\Engine\Traits\FractalTrait;

/**
 * Class ApiController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ApiController extends Controller
{
    use FractalTrait;
}
