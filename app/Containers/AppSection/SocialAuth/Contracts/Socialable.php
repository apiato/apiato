<?php

namespace App\Containers\AppSection\SocialAuth\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface Socialable
{
    public function oAuthIdentities(): HasMany;

}
