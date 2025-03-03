<?php

declare(strict_types=1);

use MohammadAlavi\ApiatoRector\Rules\RemoveGroupAttributeRector;
use MohammadAlavi\ApiatoRector\Rules\TransformMethodToResponseCreateRector;
use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/app',
        __DIR__ . '/config',
    ])
    ->withImportNames(true, false, false, true)
    ->withRules([
        RemoveGroupAttributeRector::class,
        TransformMethodToResponseCreateRector::class,
    ]);
// uncomment to reach your current PHP version
// ->withPhpSets()
//    ->withTypeCoverageLevel(0);
