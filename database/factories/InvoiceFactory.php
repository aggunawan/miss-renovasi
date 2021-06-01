<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => 'INV/' . rand(),
            'contract_number' => 'CNT/' . rand(),
            'date' => now()->toDateString(),
            'due' => now()->addDays(10)->toDateString(),
            'status' => 1,
            'contents' => [],
        ];
    }
}
