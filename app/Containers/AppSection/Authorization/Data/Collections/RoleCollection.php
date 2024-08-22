<?php

namespace App\Containers\AppSection\Authorization\Data\Collections;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Parents\Collections\EloquentCollection as ParentCollection;

/**
 * @template TKey of array-key
 * @template TModel of Role
 *
 * @extends ParentCollection<TKey, TModel>
 */
class RoleCollection extends ParentCollection
{
}
