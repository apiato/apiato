<?php

namespace App\Ship\Tests\Unit\Configs;

use App\Ship\Tests\ShipTestCase;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Enumerable;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Casts\EnumerableCast;
use Spatie\LaravelData\Normalizers\ArrayableNormalizer;
use Spatie\LaravelData\Normalizers\ArrayNormalizer;
use Spatie\LaravelData\Normalizers\JsonNormalizer;
use Spatie\LaravelData\Normalizers\ModelNormalizer;
use Spatie\LaravelData\Normalizers\ObjectNormalizer;
use Spatie\LaravelData\RuleInferrers\AttributesRuleInferrer;
use Spatie\LaravelData\RuleInferrers\BuiltInTypesRuleInferrer;
use Spatie\LaravelData\RuleInferrers\NullableRuleInferrer;
use Spatie\LaravelData\RuleInferrers\RequiredRuleInferrer;
use Spatie\LaravelData\RuleInferrers\SometimesRuleInferrer;
use Spatie\LaravelData\Support\Creation\ValidationStrategy;
use Spatie\LaravelData\Transformers\ArrayableTransformer;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\LaravelData\Transformers\EnumTransformer;

#[Group('ship')]
#[CoversNothing]
final class DataConfigTest extends ShipTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('data');
        $expected = [
            'date_format' => DATE_ATOM,
            'transformers' => [
                \DateTimeInterface::class => DateTimeInterfaceTransformer::class,
                Arrayable::class => ArrayableTransformer::class,
                \BackedEnum::class => EnumTransformer::class,
            ],
            'casts' => [
                \DateTimeInterface::class => DateTimeInterfaceCast::class,
                \BackedEnum::class => EnumCast::class,
                Enumerable::class => EnumerableCast::class,
            ],
            'rule_inferrers' => [
                SometimesRuleInferrer::class,
                NullableRuleInferrer::class,
                RequiredRuleInferrer::class,
                BuiltInTypesRuleInferrer::class,
                AttributesRuleInferrer::class,
            ],
            'normalizers' => [
                ModelNormalizer::class,
                // \Spatie\LaravelData\Normalizers\FormRequestNormalizer::class,
                ArrayableNormalizer::class,
                ObjectNormalizer::class,
                ArrayNormalizer::class,
                JsonNormalizer::class,
            ],
            'wrap' => null,
            'var_dumper_caster_mode' => 'development',
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
            'validation_strategy' => ValidationStrategy::OnlyRequests->value,
            'ignore_invalid_partials' => false,
        ];

        $this->assertSame($expected, $config);
    }
}
