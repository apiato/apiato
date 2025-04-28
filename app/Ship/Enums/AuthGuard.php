<?php

declare(strict_types=1);

namespace App\Ship\Enums;

enum AuthGuard: string
{
    case API = 'api';
    case WEB = 'web';
}
