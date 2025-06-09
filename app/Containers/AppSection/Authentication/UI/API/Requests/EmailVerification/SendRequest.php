<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\UI\API\Requests\EmailVerification;

use App\Ship\Parents\Requests\Request as ParentRequest;

final class SendRequest extends ParentRequest
{
    protected array $decode = [];

    public function rules(): array
    {
        return [];
    }
}
