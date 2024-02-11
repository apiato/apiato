<?php

namespace App\Ship\Parents\Models;

use Apiato\Core\Abstracts\Models\Model as AbstractModel;
use Spatie\LaravelData\WithData;

/**
 * @template T
 */
abstract class Model extends AbstractModel
{
    /** @use WithData<T> */
    use WithData;
}
