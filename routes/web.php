<?php

use App\Http\Controllers\BandeiraController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\GrupoEconomicoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('grupo-economico', GrupoEconomicoController::class);
    Route::resource('bandeira', BandeiraController::class);
    Route::resource('unidades', UnidadeController::class);
    Route::resource('colaboradores', ColaboradorController::class)->parameters([
        'colaboradores' => 'colaborador',
    ]);
    
    Route::get('relatorios/colaboradores', [RelatorioController::class, 'index'])->name('relatorios.colaboradores');
    Route::post('relatorios/colaboradores/export', [RelatorioController::class, 'export'])->name('relatorios.colaboradores.export');
});

require __DIR__.'/auth.php';
