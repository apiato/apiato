<?php

use Illuminate\Support\Enumerable;

return [
    /*
     * The package will use this format when working with dates. If this option
     * is an array, it will try to convert from the first format that works,
     * and will serialize dates using the first format from the array.
     */
    'date_format' => DATE_ATOM,

    /*
     * Global transformers will take complex types and transform them into simple
     * types.
     */
    'transformers' => [
        DateTimeInterface::class => Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer::class,
        Illuminate\Contracts\Support\Arrayable::class => Spatie\LaravelData\Transformers\ArrayableTransformer::class,
        BackedEnum::class => Spatie\LaravelData\Transformers\EnumTransformer::class,
    ],

    /*
     * Global casts will cast values into complex types when creating a data
     * object from simple types.
     */
    'casts' => [
        DateTimeInterface::class => Spatie\LaravelData\Casts\DateTimeInterfaceCast::class,
        BackedEnum::class => Spatie\LaravelData\Casts\EnumCast::class,
        Enumerable::class => Spatie\LaravelData\Casts\EnumerableCast::class,
    ],

    /*
     * Rule inferrers can be configured here. They will automatically add
     * validation rules to properties of a data object based upon
     * the type of the property.
     */
    'rule_inferrers' => [
        Spatie\LaravelData\RuleInferrers\SometimesRuleInferrer::class,
        Spatie\LaravelData\RuleInferrers\NullableRuleInferrer::class,
        Spatie\LaravelData\RuleInferrers\RequiredRuleInferrer::class,
        Spatie\LaravelData\RuleInferrers\BuiltInTypesRuleInferrer::class,
        Spatie\LaravelData\RuleInferrers\AttributesRuleInferrer::class,
    ],

    /*
     * Normalizers return an array representation of the payload, or null if
     * it cannot normalize the payload. The normalizers below are used for
     * every data object, unless overridden in a specific data object class.
     */
    'normalizers' => [
        Spatie\LaravelData\Normalizers\ModelNormalizer::class,
        // Spatie\LaravelData\Normalizers\FormRequestNormalizer::class,
        Spatie\LaravelData\Normalizers\ArrayableNormalizer::class,
        Spatie\LaravelData\Normalizers\ObjectNormalizer::class,
        Spatie\LaravelData\Normalizers\ArrayNormalizer::class,
        Spatie\LaravelData\Normalizers\JsonNormalizer::class,
    ],

    /*
     * Data objects can be wrapped into a key like 'data' when used as a resource,
     * this key can be set globally here for all data objects. You can pass in
     * `null` if you want to disable wrapping.
     */
    'wrap' => null,

    /*
     * Adds a specific caster to the Symphony VarDumper component which hides
     * some properties from data objects and collections when being dumped
     * by `dump` or `dd`. Can be 'enabled', 'disabled' or 'development'
     * which will only enable the caster locally.
     */
    'var_dumper_caster_mode' => 'development',

    /*
     * It is possible to skip the PHP reflection analysis of data objects
     * when running in production. This will speed up the package. You
     * can configure where data objects are stored and which cache
     * store should be used.
     */
    'structure_caching' => [
        'enabled' => true,
        'directories' => [app_path('Data')],
        'cache' => [
            'store' => env('CACHE_DRIVER', 'file'),
            'prefix' => 'laravel-data',
        ],
        'reflection_discovery' => [
            'enabled' => true,
            'base_path' => base_path(),
            'root_namespace' => null,
        ],
    ],

    /*
     * A data object can be validated when created using a factory or when calling the from
     * method. By default, only when a request is passed the data is being validated. This
     * behaviour can be changed to always validate or to completely disable validation.
     */
    'validation_strategy' => Spatie\LaravelData\Support\Creation\ValidationStrategy::OnlyRequests->value,

    /*
     * When using an invalid include, exclude, only or except partial, the package will
     * throw an
     */
    'ignore_invalid_partials' => false,
];
