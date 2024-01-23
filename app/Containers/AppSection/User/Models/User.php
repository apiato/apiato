<?php

namespace App\Containers\AppSection\User\Models;

use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authorization\Traits\AuthorizationTrait;
use App\Containers\AppSection\User\Enums\Gender;
use App\Ship\Contracts\MustVerifyEmail;
use App\Ship\Parents\Models\UserModel as ParentUserModel;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends ParentUserModel implements MustVerifyEmail
{
    use AuthorizationTrait;

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

    protected function email(): Attribute
    {
        return new Attribute(
            get: static fn (string|null $value): string|null => null === $value ? null : strtolower($value),
        );
    }

    /**
     * Allows Passport to authenticate users with custom fields.
     */
    public function findForPassport($identifier): self|null
    {
        $allowedLoginAttributes = config('appSection-authentication.login.attributes', ['email' => []]);

        $query = $this->newModelQuery();

        foreach (array_keys($allowedLoginAttributes) as $field) {
            if (config('appSection-authentication.login.case_sensitive')) {
                $query->orWhere($field, $identifier);
            } else {
                $query->orWhereRaw("lower({$field}) = lower(?)", [$identifier]);
            }
        }

        return $query->first();
    }
}
