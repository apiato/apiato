<?php

namespace App\Ship\Model\Abstracts;

use App\Ship\HashId\Traits\HashIdTrait;
use Illuminate\Database\Eloquent\Model as LaravelEloquentModel;

/**
 * Class Model.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Model extends LaravelEloquentModel
{

    use HashIdTrait;

}
