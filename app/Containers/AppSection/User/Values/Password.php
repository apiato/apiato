<?php

namespace App\Containers\AppSection\User\Values;

use App\Ship\Parents\Values\Value as ParentValue;

class Password extends ParentValue
{
    public function __construct(public readonly string $password)
    {
    }
}
