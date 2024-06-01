<?php

namespace App\Ship\Macros\Fractal;

use Illuminate\Http\JsonResponse;
use Spatie\Fractal\Fractal;

class NoContent {
    public function __invoke(): callable
    {
        return function (): JsonResponse {
            /** @var Fractal $this */
            return $this->respond(204);
        };
    }
}
