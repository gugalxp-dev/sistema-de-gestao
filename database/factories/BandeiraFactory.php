<?php

namespace Database\Factories;

use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use Illuminate\Database\Eloquent\Factories\Factory;

class BandeiraFactory extends Factory
{
    protected $model = Bandeira::class;

    public function definition()
    {
        return [
            'grupo_economico_id' => GrupoEconomico::factory(),
            'nome' => $this->faker->company,
        ];
    }
}
