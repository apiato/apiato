<?php

declare(strict_types=1);

namespace App\Ship\Parents\Collections;

use Apiato\Core\Collections\EloquentCollection as AbstractEloquentCollection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TKey of array-key
 * @template TModel of Model
 *
 * @extends AbstractEloquentCollection<TKey, TModel>
 *
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class EloquentCollection extends AbstractEloquentCollection
{
}
