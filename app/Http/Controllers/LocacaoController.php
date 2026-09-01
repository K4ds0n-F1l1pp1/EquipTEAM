<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use App\Models\Cliente;
use App\Models\Equipamentos;
use Illuminate\Http\Request;

class LocacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dados = Locacao::All(); // Dá um SELECT ALL, literalmente.

        return view('locacao.list')->with(['dados' => $dados]); // Retorna a formação da View, onde é processado os dados
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $equipamentos = Equipamentos::all();

        return view('locacao.form', compact('clientes', 'equipamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validationForm($request);

        Locacao::create($request->all());

        return redirect()->route('locacao.index')->with('success', 'Registro salvo com sucesso!');
    }

    public function validationForm(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'equipamento_id' => 'required',
            'data_retirada' => 'required|date',
            'data_devolucao_previsa' => 'required|date',
            'valor_total' => 'required|numeric',
            'status' => 'required',
        ], [
            'cliente_id.required' => 'O :attribute é obrigatório!',
            'equipamento_id.required' => 'O :attribute é obrigatório!',
            'data_retirada.required' => 'O :attribute é obrigatório!',
            'data_retirada.date' => 'O :attribute deve ser uma data válida!',
            'data_devolucao_previsa.required' => 'O :attribute é obrigatório!',
            'data_devolucao_previsa.date' => 'O :attribute deve ser uma data válida!',
            'valor_total.required' => 'O :attribute é obrigatório!',
            'valor_total.numeric' => 'O :attribute deve ser um número!',
            'status.required' => 'O :attribute é obrigatório!',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Locacao::find($id);
        $clientes = Cliente::all();
        $equipamentos = Equipamentos::all();

        return view('locacao.form', compact('data', 'clientes', 'equipamentos'));
    }

    public function update(Request $request, $id)
    {
        $this->validationForm($request);

        Locacao::find($id)->update($request->all());

        return redirect()->route('locacao.index')->with('success', 'Registro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Locacao::destroy($id);

        return redirect()->route('locacao.index')->with('success', 'Registro removido com sucesso!');
    }
}
