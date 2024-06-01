<?php

namespace App\Ship\Providers\MacroProviders;

use App\Ship\Macros\Fractal\Accepted;
use App\Ship\Macros\Fractal\Created;
use App\Ship\Macros\Fractal\NoContent;
use App\Ship\Macros\Fractal\Ok;
use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;
use Illuminate\Support\Collection;
use Spatie\Fractal\Fractal;

class FractalMacroServiceProvider extends ParentMainServiceProvider {
    public function boot(): void
    {
        parent::boot();

        Collection::make($this->macros())
            ->reject(static fn ($class, $macro) => Fractal::hasMacro($macro))
            ->each(static fn ($class, $macro) => Fractal::macro($macro,  app($class)()));
    }

    private function macros(): array
    {
        return [
            'ok' => Ok::class,
            'created' => Created::class,
            'noContent' => NoContent::class,
            'accepted' => Accepted::class,
        ];
    }
}
