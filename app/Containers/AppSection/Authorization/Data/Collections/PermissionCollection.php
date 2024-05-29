<?php

namespace App\Containers\AppSection\Authorization\Data\Collections;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Ship\Parents\Collections\EloquentCollection as ParentCollection;

/**
 * @template TKey of array-key
 * @template TModel of Permission
 *
 * @extends ParentCollection<TKey, TModel>
 */
class PermissionCollection extends ParentCollection
{
}
