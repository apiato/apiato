<?php

namespace App\Containers\AppSection\SocialAuth\Enums;

enum AuthAction: string
{
    case Signup = 'signup';
    case Login = 'login';
}
