<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sales>
 */
class SalesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // nomor cdso CDSO2201-00126 angkanya di random 
            'nomorcdso' => 'CDSO2201-00' . $this->faker->numberBetween(1, 400),
            'customer_id'=> $this->faker->numberBetween(1, 2100),
            'tanggal_penjualan' => $this->faker->date(),
            
        ];
    }
}
