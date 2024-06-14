<?php

namespace App\Containers\AppSection\User\Data\Collections;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Collections\EloquentCollection as ParentCollection;

/**
 * @template TKey of array-key
 * @template TModel of User
 *
 * @extends ParentCollection<TKey, TModel>
 */
class UserCollection extends ParentCollection
{
}
