<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Pagamento;

class FormaPagamentoChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        // Busca os dados agrupados por forma de pagamento
        $formasPagamento = Pagamento::select('forma_pagamento', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('forma_pagamento')
            ->get();

        return $this->chart->donutChart()
            ->setTitle('Formas de Pagamento')
            ->setDataset($formasPagamento->pluck('total')->toArray())
            ->setLabels($formasPagamento->pluck('forma_pagamento')->toArray());
    }
}