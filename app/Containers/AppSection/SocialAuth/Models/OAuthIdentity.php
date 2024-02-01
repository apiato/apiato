<?php

namespace App\Containers\AppSection\SocialAuth\Models;

use Apiato\Core\Abstracts\Models\Model;
use App\Containers\AppSection\SocialAuth\SocialAuth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webmozart\Assert\Assert;

// TODO: Should I extract an interface for this model?
// TODO: Should I extract a trait for this model?
// TODO: Is SocialIdentity a better name?
class OAuthIdentity extends Model
{
    protected $table = 'oauth_identities';

    protected $fillable = [
        'user_id',
        'provider',
        'social_id',
        'nickname',
        'name',
        'email',
        'avatar',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(SocialAuth::userModel(), 'user_id');
    }

    public function linkUser($user): void
    {
        Assert::isInstanceOf($user, SocialAuth::userModel());

        $this->user()->associate($user);
        $this->save();
    }

    public function unlinkUser(): void
    {
        $this->user()->disassociate();
        $this->delete();
        $this->save();
    }

    public function getProvider(): string
    {
        return $this->provider;
    }

    public function getSocialId(): string
    {
        return $this->social_id;
    }

    public function getNickname(): string|null
    {
        return $this->nickname;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getEmail(): string|null
    {
        return $this->email;
    }

    public function getAvatar(): string|null
    {
        return $this->avatar();
    }
}
