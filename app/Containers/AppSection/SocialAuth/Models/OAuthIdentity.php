<?php

namespace App\Containers\AppSection\SocialAuth\Models;

use Apiato\Core\Abstracts\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Socialite\Two\User;

class OAuthIdentity extends Model
{
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
        return $this->belongsTo(config('vendor-socialAuth.user.user_model'), 'user_id');
    }
}
