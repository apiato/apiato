<?php

declare(strict_types=1);

use App\Ship\Linters\Rector\MockObjectStaticToInstanceCallRector;
use Rector\CodeQuality\Rector\ClassMethod\LocallyCalledStaticMethodToNonStaticRector;
use Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector;
use Rector\CodeQuality\Rector\Identical\SimplifyBoolIdenticalTrueRector;
use Rector\CodeQuality\Rector\Isset_\IssetOnPropertyObjectToPropertyExistsRector;
use Rector\CodingStyle\Rector\ClassMethod\MakeInheritedMethodVisibilitySameAsParentRector;
use Rector\CodingStyle\Rector\PostInc\PostIncDecToPreIncDecRector;
use Rector\CodingStyle\Rector\Use_\SeparateMultiUseImportsRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\StaticCall\RemoveParentCallWithoutParentRector;
use Rector\Naming\Rector\Class_\RenamePropertyToMatchTypeRector;
use Rector\Naming\Rector\ClassMethod\RenameParamToMatchTypeRector;
use Rector\Php71\Rector\FuncCall\RemoveExtraParametersRector;
use Rector\Php73\Rector\BooleanOr\IsCountableRector;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\Php74\Rector\Property\RestoreDefaultNullToNullableTypePropertyRector;
use Rector\PHPUnit\CodeQuality\Rector\Class_\PreferPHPUnitThisCallRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\AddMethodCallBasedStrictParamTypeRector;
use Rector\ValueObject\PhpVersion;
use RectorLaravel\Set\LaravelLevelSetList;
use RectorLaravel\Set\LaravelSetList;

return RectorConfig::configure()
    // https://getrector.com/documentation/troubleshooting-parallel
    ->withParallel(360, 2, 40)
    ->withImportNames(importDocBlockNames: false, importShortClasses: false)
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        privatization: true,
        naming: true,
        instanceOf: true,
        earlyReturn: true,
        strictBooleans: true,
        carbon: true,
        rectorPreset: true,
        phpunitCodeQuality: true,
        doctrineCodeQuality: false,
        symfonyCodeQuality: true,
        symfonyConfigs: false,
    )
    ->withAttributesSets(
        doctrine: false,
        phpunit: true,
    )
    ->withRules([
        MockObjectStaticToInstanceCallRector::class,
    ])
    ->withSets([
        PHPUnitSetList::PHPUNIT_90,
        PHPUnitSetList::PHPUNIT_100,
//        PHPUnitSetList::PHPUNIT_110,
        PHPUnitSetList::PHPUNIT_CODE_QUALITY,
        PHPUnitSetList::ANNOTATIONS_TO_ATTRIBUTES,

        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::TYPE_DECLARATION,
        SetList::EARLY_RETURN,
        SetList::STRICT_BOOLEANS,

        LevelSetList::UP_TO_PHP_83,
        LaravelLevelSetList::UP_TO_LARAVEL_100,
        LaravelSetList::LARAVEL_100,
        LaravelSetList::LARAVEL_CODE_QUALITY,
        LaravelSetList::LARAVEL_ARRAY_STR_FUNCTION_TO_STATIC_CALL,
    ])
    ->withPhpVersion(PhpVersion::PHP_83)
    ->withPaths([
        __DIR__ . '/app',
        __DIR__ . '/database',
    ])
    ->withSkip([
        SimplifyBoolIdenticalTrueRector::class, // it's breaks the Routers
        IsCountableRector::class, // this rule does not fit, a lot of where it goes wrong
        RestoreDefaultNullToNullableTypePropertyRector::class, // don't work with DTO nullable parameter
        RemoveExtraParametersRector::class, // catting an argument in dump() function
        ClosureToArrowFunctionRector::class, // it's breaks the Routers
        SeparateMultiUseImportsRector::class, // it's breaks the using multiple Traits
        LocallyCalledStaticMethodToNonStaticRector::class,
        PreferPHPUnitThisCallRector::class, // it's breaks with phpstan
        RenamePropertyToMatchTypeRector::class, // it's breaks the Entity

        //        THINKING
        AddMethodCallBasedStrictParamTypeRector::class, // it's breaks the using multiple Traits
        FlipTypeControlToUseExclusiveTypeRector::class,
        IssetOnPropertyObjectToPropertyExistsRector::class,
        RenameParamToMatchTypeRector::class,
        PostIncDecToPreIncDecRector::class,

        //        WAITING FIX
        MakeInheritedMethodVisibilitySameAsParentRector::class,
        RemoveParentCallWithoutParentRector::class,

        //        THINKING LARAVEL
//        ModelCastsPropertyToCastsMethodRector::class,
//        MigrateToSimplifiedAttributeRector::class,
    ])
    ->withFileExtensions(['php'])
    ;
