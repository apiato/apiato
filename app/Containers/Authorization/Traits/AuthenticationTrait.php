<?php

namespace App\Containers\Authorization\Traits;

trait AuthenticationTrait
{
    /**
     * Allows Passport to authenticate users with custom fields.
     * @param $identifier
     * @return AuthenticationTrait
     */
    public function findForPassport($identifier): AuthenticationTrait
    {
        $allowedLoginAttributes = config('authentication-container.login.attributes', ['email' => []]);

        $builder = $this;
        foreach (array_keys($allowedLoginAttributes) as $field) {
            $builder = $builder->orWhere($field, $identifier);
        }

        return $builder->first();
    }
}
