<?php

namespace Database\Factories;

use App\Models\InvoiceHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'message' => $this->faker->text(),
        ];
    }
}
