<?php

namespace App\Containers\AppSection\User\Data\Collections;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Collections\EloquentCollection as ParentCollection;

/**
 * @extends ParentCollection<array-key, User>
 */
final class UserCollection extends ParentCollection
{
}
