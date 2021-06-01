<?php

namespace Database\Factories;

use App\Models\PaymentAlert;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentAlertFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentAlert::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => 1,
        ];
    }
}
