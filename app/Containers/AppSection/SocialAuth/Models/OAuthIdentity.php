<?php

namespace App\Containers\AppSection\SocialAuth\Models;

use Apiato\Core\Abstracts\Models\Model;
use App\Containers\AppSection\SocialAuth\SocialAuth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Socialite\Two\User;
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

    public function linkUser($user): self
    {
        Assert::isInstanceOf($user, SocialAuth::userModel());

        $this->user()->associate($user);
        $this->save();

        return $this;
    }

    public function unlinkUser(): self
    {
        $this->user()->disassociate();
        $this->delete();
        $this->save();

        return $this;
    }

    public function getProvider(): string
    {
        return $this->provider;
    }

    public function getSocialId(): string
    {
        return $this->social_id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public static function fromOAuthUser(User $user, string $provider): static
    {
        return new static([
            'provider' => $provider,
            'social_id' => $user->getId(),
            'nickname' => $user->getNickname(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'avatar' => $user->getAvatar(),
        ]);
    }
}
