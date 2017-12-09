<?php

namespace App\Ship\Parents\Requests;

use Apiato\Core\Abstracts\Requests\Request as AbstractRequest;
use App\Ship\Defaults\Transporters\DefaultTransporter;

/**
 * Class Request
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class Request extends AbstractRequest
{

    /**
     * @var string
     */
    protected $transporter = DefaultTransporter::class;
}
