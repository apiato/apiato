<?php

namespace App\Containers\AppSection\SocialAuth\Models;

use Apiato\Core\Abstracts\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Socialite\Two\User;

class SocialAccount extends Model
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

    //    public static function fromOAuthTwoUser(User $oAuthTwoUser): static
    //    {
    // //        $this->provider = $oAuthTwoUser->provider;
    // //        $this->social_id = $oAuthTwoUser->id;
    // //        $this->nickname = $oAuthTwoUser->nickname;
    // //        $this->name = $oAuthTwoUser->name;
    // //        $this->avatar = $oAuthTwoUser->avatar;
    // //        $this->token = $oAuthTwoUser->token;
    // //        $this->token_secret = $oAuthTwoUser->tokenSecret;
    // //        $this->refresh_token = $oAuthTwoUser->refreshToken;
    // //        $this->expires_in = $oAuthTwoUser->expiresIn;
    // //        $this->scopes = json_encode($oAuthTwoUser->approvedScopes, JSON_THROW_ON_ERROR);
    //
    //        return static::ma([
    //            'provider' => $oAuthTwoUser->provider,
    //            'social_id' => $oAuthTwoUser->id,
    //            'nickname' => $oAuthTwoUser->nickname,
    //            'name' => $oAuthTwoUser->name,
    //            'avatar' => $oAuthTwoUser->avatar,
    //            'token' => $oAuthTwoUser->token,
    //            'refresh_token' => $oAuthTwoUser->refreshToken,
    //            'expires_in' => $oAuthTwoUser->expiresIn,
    //            'scopes' => json_encode($oAuthTwoUser->approvedScopes, JSON_THROW_ON_ERROR),
    //        ]);
    //    }
}
