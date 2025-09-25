<?php

namespace Database\Factories;

use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColaboradorFactory extends Factory
{
    protected $model = Colaborador::class;

    public function definition()
    {
        return [
            'unidade_id' => Unidade::factory(),
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cpf' => $this->faker->numerify('###########'),
        ];
    }
}
