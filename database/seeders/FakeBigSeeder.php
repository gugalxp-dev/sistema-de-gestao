<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bandeira;
use App\Models\Unidade;
use App\Models\Colaborador;

class FakeBigSeeder extends Seeder
{
    public function run()
    {
        $bandeiras = Bandeira::factory()->count(50)->create();

        $unidades = $bandeiras->flatMap(function($bandeira) {
            return Unidade::factory()
                ->count(20)
                ->create(['bandeira_id' => $bandeira->id]);
        });

        $unidades->each(function($unidade) {
            Colaborador::factory()
                ->count(20)
                ->create(['unidade_id' => $unidade->id]);
        });
    }
}
