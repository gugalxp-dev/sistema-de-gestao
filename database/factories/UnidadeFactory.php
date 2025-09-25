<?php

namespace Database\Factories;

use App\Models\Bandeira;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnidadeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome_fantasia' => $this->faker->company(),
            'razao_social' => $this->faker->company().' LTDA',
            'cnpj' => $this->faker->numerify('##############'),
            'bandeira_id' => Bandeira::inRandomOrder()->first()->id,
        ];
    }
}
