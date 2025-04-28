<?php

declare(strict_types=1);

namespace App\Ship\Parents\Policies;

use Apiato\Core\Abstracts\Policies\Policy as AbstractPolicy;
use App\Ship\Contracts\Authorizable;

abstract class Policy extends AbstractPolicy
{
    public function before(Authorizable $authorizable, string $ability): null|bool
    {
        if ($authorizable->hasAdminRole()) {
            return true;
        }

        return null;
    }
}
