<?php

namespace App\Containers\AppSection\Authentication\Enums;

enum AllowedLoginField: string
{
    case EMAIL = 'email';
    case NAME = 'name';

    /**
     * @throws \Exception
     */
    public function rule(): string
    {
        return match ($this) {
            AllowedLoginField::EMAIL => 'required|email',
            AllowedLoginField::NAME => 'string',
        };
    }
}
