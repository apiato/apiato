<?php

declare(strict_types=1);

namespace App\Ship\Tests\Fakes\Policies;

use App\Ship\Parents\Requests\Request;
use App\Ship\Tests\Fakes\TestUser;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Auth\Access\Gate;

class FakeDeletePoliciesRequest extends Request
{
    public function authorize(Gate $gate): Response
    {
        return $gate->inspect(
            /** @uses TestUserPolicy::delete() */
            'delete',
            TestUser::class,
        );
    }
}
