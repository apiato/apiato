<?php

namespace App\Containers\AppSection\User\UI\API\Transformers;

use App\Containers\AppSection\User\Contracts\Transformers\IncludePermissions;
use App\Containers\AppSection\User\Contracts\Transformers\IncludeRoles;

class UserTransformer extends AbstractUserTransformer implements IncludeRoles, IncludePermissions
{
}
