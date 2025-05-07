<?php

namespace App\Containers\AppSection\Authorization\Data\Collections;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Ship\Parents\Collections\EloquentCollection as ParentCollection;

/**
 * @extends ParentCollection<array-key, Permission>
 */
final class PermissionCollection extends ParentCollection
{
}
