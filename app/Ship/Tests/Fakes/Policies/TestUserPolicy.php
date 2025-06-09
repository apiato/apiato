<?php

declare(strict_types=1);

namespace App\Ship\Tests\Fakes\Policies;

use App\Ship\Parents\Models\UserModel;
use App\Ship\Parents\Policies\Policy;
use Illuminate\Auth\Access\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class TestUserPolicy extends Policy
{
    public function create(UserModel $user): Response
    {
        return $this->allow('create', SymfonyResponse::HTTP_CREATED);
    }

    public function view(UserModel $user): bool
    {
        return true;
    }

    public function update(UserModel $user): bool
    {
        return false;
    }

    public function delete(UserModel $user): Response
    {
        return $this->deny('delete', SymfonyResponse::HTTP_FORBIDDEN);
    }
}
