<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Enums;

enum Gender: string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case UNSPECIFIED = 'unspecified';
}
