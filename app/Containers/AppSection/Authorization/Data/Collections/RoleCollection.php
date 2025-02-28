<?php

namespace App\Containers\AppSection\Authorization\Data\Collections;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Parents\Collections\EloquentCollection as ParentCollection;

/**
 * @extends ParentCollection<array-key, Role>
 */
final class RoleCollection extends ParentCollection
{
}
