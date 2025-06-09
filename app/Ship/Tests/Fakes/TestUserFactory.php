<?php

declare(strict_types=1);

namespace App\Ship\Tests\Fakes;

use App\Ship\Parents\Factories\Factory as ParentFactory;

/**
 * @template TModel of TestUser
 *
 * @extends ParentFactory<TModel>
 */
class TestUserFactory extends ParentFactory
{
    /** @var class-string<TModel> */
    protected $model = TestUser::class;

    public function definition(): array
    {
        return [
            'name'      => fake()->name(),
            'email'     => fake()->unique()->safeEmail(),
            'age'       => fake()->numberBetween(18, 80),
            'active'    => true,
            'score'     => fake()->randomFloat(1, 0, 5),
            'published' => fake()->randomElement(['yes', 'no']),
            'metadata'  => [],
        ];
    }
}
