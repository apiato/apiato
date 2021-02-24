<?php

namespace App\Containers\Stripe\Data\Factories;

use App\Containers\Stripe\Models\StripeAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

class StripeAccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StripeAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'customer_id' => $this->faker->text(10),
        ];
    }
}
