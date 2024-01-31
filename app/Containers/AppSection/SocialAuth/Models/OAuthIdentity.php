<?php

namespace App\Containers\AppSection\SocialAuth\Models;

use Apiato\Core\Abstracts\Models\Model;
use App\Containers\AppSection\SocialAuth\SocialAuth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Socialite\Two\User;

class OAuthIdentity extends Model
{
    protected $table = 'oauth_identities';

    protected $fillable = [
        'user_id',
        'provider',
        'social_id',
        'email',
        'nickname',
        'name',
        'avatar',
        'token',
        'refresh_token',
        'expires_in',
        'scopes',
    ];

    protected $casts = [
        'scopes' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(SocialAuth::userModel(), 'user_id');
    }
}
