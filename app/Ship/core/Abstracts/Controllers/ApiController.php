<?php

namespace Apiato\Core\Abstracts\Controllers;

use Apiato\Core\Traits\ResponseTrait;

/**
 * Class ApiController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ApiController extends Controller
{

    use ResponseTrait;

    /**
     * The type of this controller. This will be accessible mirrored in the Actions.
     * Giving each Action the ability to modify it's internal business logic based on the UI type that called it.
     *
     * @var  string
     */
    public $ui = 'api';

}
