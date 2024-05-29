<?php

namespace App\Ship\Parents\Collections;

use Illuminate\Database\Eloquent\Model;
use Apiato\Core\Abstracts\Collections\EloquentCollection as AbstractEloquentCollection;

/**
 * @template TKey of array-key
 * @template TModel of Model
 *
 * @extends AbstractEloquentCollection<TKey, TModel>
 */
abstract class EloquentCollection extends AbstractEloquentCollection
{
}
