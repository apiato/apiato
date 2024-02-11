<?php

namespace App\Ship\Parents\Requests;

use Apiato\Core\Abstracts\Requests\Request as AbstractRequest;
use Spatie\LaravelData\WithData;

/**
 * @template T
 */
abstract class Request extends AbstractRequest
{
    /** @use WithData<T> */
    use WithData;
}
