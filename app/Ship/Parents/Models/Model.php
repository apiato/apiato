<?php

namespace App\Ship\Parents\Models;

use App\Ship\Engine\Traits\HashIdTrait;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model as LaravelEloquentModel;

/**
 * Class Model.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Model extends LaravelEloquentModel
{
    use HashIdTrait;
    use Searchable;
}
