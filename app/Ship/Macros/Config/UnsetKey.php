<?php

namespace App\Ship\Macros\Config;

use Illuminate\Config\Repository;
use Illuminate\Support\Arr;

class UnsetKey {
    public function __invoke(): callable
    {
        return function (array|string|int|float $key): void {
            /** @var Repository $this */
            Arr::forget($this->items, $key);
        };
    }
}
