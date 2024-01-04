<?php

namespace App\Containers\AppSection\SocialAuth\Contracts;

interface SocialAuthProvider
{
    public function getUser();
}
