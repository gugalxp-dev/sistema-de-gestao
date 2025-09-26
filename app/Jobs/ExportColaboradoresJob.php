<?php

namespace App\Jobs;

use App\Exports\ColaboradoresExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportColaboradoresJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $fileName;
    public $colaboradorIds;
    public $timeout = 1200;

    public function __construct($fileName, $colaboradorIds)
    {
        $this->fileName = $fileName;
        $this->colaboradorIds = $colaboradorIds;
    }

    public function handle()
    {
        // Salva direto na pasta public/exports
        Excel::store(new ColaboradoresExport($this->colaboradorIds), "public/exports/{$this->fileName}.xlsx");
    }
}
