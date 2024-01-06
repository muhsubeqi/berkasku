<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubKategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kategori_id' => $this->faker->randomElement([1.2]),
            'nama_sub_kategori' => $this->faker->name,
        ];
    }
}
