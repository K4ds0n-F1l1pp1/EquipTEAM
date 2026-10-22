<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Equipamentos;
use Illuminate\Support\Facades\DB;

class StatusEquipamentoChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Busca os dados direto do banco agrupados por status
        $statusEquipamentos = Equipamentos::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        return $this->chart->barChart()
            ->setTitle('Status dos Equipamentos')
            ->setDataset([
                [
                    'name' => 'Quantidade',
                    'data' => $statusEquipamentos->pluck('total')->toArray()
                ]
            ])
            ->setXAxis($statusEquipamentos->pluck('status')->toArray())
            ->setColors(['#ffc107', '#198754', '#dc3545']);
    }
}
