<?php

namespace App\Containers\AppSection\Authentication\Data\Dto;

use Apiato\Http\Resources\HasResourceKey;
use Apiato\Http\Resources\ResourceKeyAware;

final readonly class IncomingLoginField implements ResourceKeyAware
{
    use HasResourceKey;

    public function __construct(
        public string $name,
        public string $value,
    ) {
    }
}
