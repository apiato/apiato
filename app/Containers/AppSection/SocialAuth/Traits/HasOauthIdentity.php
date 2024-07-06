<?php

namespace App\Containers\AppSection\SocialAuth\Traits;

use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasOauthIdentity
{
    public function oAuthIdentities(): HasMany
    {
        return $this->hasMany(OAuthIdentity::class, 'user_id');
    }

    // override
    // findForPassport()

    // implement: delete social profile when user is deleted
    // bootHasRoles

    // can all of this be implemented on user/socialProfile repository?

    // link social profile
    // linkSocialProfile()

    // unlink social profile
    // unlinkSocialProfile()

    // has social profile
    // hasSocialProfile()
}
