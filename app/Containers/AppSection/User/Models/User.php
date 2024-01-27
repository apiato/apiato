<?php

namespace App\Containers\AppSection\User\Models;

use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\User\Enums\Gender;
use App\Ship\Contracts\MustVerifyEmail;
use App\Ship\Parents\Models\UserModel as ParentUserModel;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends ParentUserModel implements MustVerifyEmail
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'birth',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birth' => 'date',
        'gender' => Gender::class,
    ];

    public function sendEmailVerificationNotificationWithVerificationUrl(string $verificationUrl): void
    {
        $this->notify(new VerifyEmail($verificationUrl));
    }

    final public function getHashedEmailForVerification(): string
    {
        return sha1($this->getEmailForVerification());
    }

    /**
     * Allows Passport to authenticate users with custom fields.
     */
    public function findForPassport(string $username): self|null
    {
        $allowedLoginFields = array_keys(config('appSection-authentication.login.fields', ['email' => []]));
        $query = $this->newModelQuery();

        foreach ($allowedLoginFields as $field) {
            if (config('appSection-authentication.login.case_sensitive')) {
                $query->orWhere($field, $username);
            } else {
                $query->orWhereRaw("lower({$field}) = lower(?)", [$username]);
            }
        }

        return $query->first();
    }

    public function hasAdminRole(): bool
    {
        return $this->hasRole(config('appSection-authorization.admin_role'));
    }

    protected function email(): Attribute
    {
        return new Attribute(
            get: static fn (string|null $value): string|null => null === $value ? null : strtolower($value),
        );
    }
}
