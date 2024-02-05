<?php

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
            'name' => $this->faker->name(),
        ];
    }
}
