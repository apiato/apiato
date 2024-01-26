<?php

namespace App\Ship\Enums;

enum AuthGuard: string
{
    case API = 'api';
    case WEB = 'web';
}
