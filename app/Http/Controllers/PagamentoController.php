<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Locacao;
    use Barryvdh\DomPDF\Facade\Pdf;

class PagamentoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        if($search) {
            $dados = Pagamento::where('status', 'like', '%' . $search . '%')
                              ->orWhere('forma_pagamento', 'like', '%' . $search . '%')
                              ->get();
        } else {
            $dados = Pagamento::all();
        }

        return view('pagamento.list', compact('dados', 'search'));
    }

    public function create()
    {
        $locacoes = Locacao::all();
        return view('pagamento.form', compact('locacoes'));
    }

    public function validationForm(Request $request)
    {
        $request->validate([
            'locacao_id' => 'required',
            'valor' => 'required|numeric',
            'forma_pagamento' => 'required',
            'status' => 'required',
        ], [
            'locacao_id.required' => 'A locação é obrigatória!',
            'valor.required' => 'O valor é obrigatório!',
            'valor.numeric' => 'O valor deve ser um número!',
            'forma_pagamento.required' => 'A forma de pagamento é obrigatória!',
            'status.required' => 'O status é obrigatório!',
        ]);
    }

    public function store(Request $request)
    {
        $this->validationForm($request);

        Pagamento::create($request->all());

        return redirect()->route('pagamento.index')->with('success', 'Pagamento salvo com sucesso!');
    }

    public function edit($id)
    {
        $data = Pagamento::find($id);
        $locacoes = Locacao::all();

        return view('pagamento.form', compact('data', 'locacoes'));
    }

    public function update(Request $request, $id)
    {
        $this->validationForm($request);

        Pagamento::find($id)->update($request->all());

        return redirect()->route('pagamento.index')->with('success', 'Pagamento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Pagamento::destroy($id);

        return redirect()->route('pagamento.index')->with('success', 'Pagamento removido com sucesso!');
    }

    public function report()
    {
        $pagamentos = Pagamento::orderBy('id')->get();

        $data = [
            'titulo' => 'Relatório de Pagamentos',
            'date' => date('m/d/Y'),
            'dados' => $pagamentos
        ];

        $pdf = Pdf::loadView('pagamento.report', $data);

        return $pdf->download('relatorio_pagamentos.pdf');
    }
}