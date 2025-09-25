<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoEconomicoFactory extends Factory
{
    protected $model = \App\Models\GrupoEconomico::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->company,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
