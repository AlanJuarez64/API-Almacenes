<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Almacen;

class AlmacenFactory extends Factory
{
    protected $model = Almacen::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'Capacidad' => $this->faker->randomFloat(2, 15, 50)
        ];
    }
}
