<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MetricasExport implements FromCollection, WithHeadings
{
    private $startDate;
    private $endDate;
    private $userId;

    public function __construct($request)
    {
        $this->startDate = $request->startDate;
        $this->endDate = $request->endDate;
        $this->userId = $request->userId;
    }

    public function headings(): array
    {
        return [
            "id_publicacao", "titulo", "data_inicio",
            "data_fim", "total_doacoes"
        ];
    }

    public function collection()
    {
        return DB::table('publicacoes')
            ->leftJoin('doacoes', 'publicacoes.id', '=', 'doacoes.id_publicacao')
            ->select(
                'publicacoes.id',
                'publicacoes.titulo',
                'publicacoes.dt_inicio',
                'publicacoes.dt_fim',
                DB::raw('count(doacoes.id) as nr_doacoes')
            )
            ->whereDate('publicacoes.created_at', '>=', $this->startDate)
            ->whereDate('publicacoes.created_at', '<=', $this->endDate)
            ->where("publicacoes.id_usuario", "=", $this->userId)
            ->where("doacoes.id_status", "=", 2)
            ->groupBy(
                'publicacoes.id',
                'publicacoes.titulo',
                'publicacoes.dt_inicio',
                'publicacoes.dt_fim'
                )
            ->get();
    }
}
