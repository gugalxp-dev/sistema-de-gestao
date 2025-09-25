<?php

namespace Database\Factories;

use App\Models\GrupoEconomico;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoEconomicoFactory extends Factory
{
    protected $model = GrupoEconomico::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->company . ' Group',
        ];
    }
}
