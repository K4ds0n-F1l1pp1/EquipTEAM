<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use App\Models\Cliente;
use App\Models\Equipamentos;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LocacaoController extends Controller
{
    public function index()
    {
        $dados = Locacao::with(['cliente', 'equipamento'])->get();

        return view('locacao.list')->with(['dados' => $dados]);
    }

    public function create()
    {
        $clientes = Cliente::all();
        $equipamentos = Equipamentos::where('status', 'disponivel')->get();

        return view('locacao.form', compact('clientes', 'equipamentos'));
    }

    public function store(Request $request)
    {
        $this->validationForm($request);

        $equipamento = Equipamentos::find($request->equipamento_id);

        if ($equipamento->status !== 'disponivel') {
            return redirect()->back()->with('error', 'Este equipamento já está alugado!');
        }

        $dias = Carbon::parse($request->data_retirada)->diffInDays(Carbon::parse($request->data_devolucao_previsa));
        $dias = $dias > 0 ? $dias : 1; // mínimo de 1 dia

        Locacao::create([
            'cliente_id' => $request->cliente_id,
            'equipamento_id' => $request->equipamento_id,
            'data_retirada' => $request->data_retirada,
            'data_devolucao_previsa' => $request->data_devolucao_previsa,
            'valor_total' => $dias * $equipamento->valor_diaria,
        ]);

        $equipamento->update(['status' => 'alugado']);

        return redirect()->route('locacao.index')->with('success', 'Registro salvo com sucesso!');
    }

    public function validationForm(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'equipamento_id' => 'required',
            'data_retirada' => 'required|date',
            'data_devolucao_previsa' => 'required|date',
        ], [
            'cliente_id.required' => 'O :attribute é obrigatório!',
            'equipamento_id.required' => 'O :attribute é obrigatório!',
            'data_retirada.required' => 'O :attribute é obrigatório!',
            'data_retirada.date' => 'O :attribute deve ser uma data válida!',
            'data_devolucao_previsa.required' => 'O :attribute é obrigatório!',
            'data_devolucao_previsa.date' => 'O :attribute deve ser uma data válida!',
        ]);
    }

    public function edit($id)
    {
        $data = Locacao::find($id);
        $clientes = Cliente::all();
        $equipamentos = Equipamentos::all(); // aqui mostra todos, já que o atual já está "alugado" com ele mesmo

        return view('locacao.form', compact('data', 'clientes', 'equipamentos'));
    }

    public function update(Request $request, $id)
    {
        $this->validationForm($request);

        $locacao = Locacao::find($id);
        $equipamento = Equipamentos::find($request->equipamento_id);

        $dias = Carbon::parse($request->data_retirada)->diffInDays(Carbon::parse($request->data_devolucao_previsa));
        $dias = $dias > 0 ? $dias : 1;

        $locacao->update([
            'cliente_id' => $request->cliente_id,
            'equipamento_id' => $request->equipamento_id,
            'data_retirada' => $request->data_retirada,
            'data_devolucao_previsa' => $request->data_devolucao_previsa,
            'valor_total' => $dias * $equipamento->valor_diaria,
        ]);

        return redirect()->route('locacao.index')->with('success', 'Registro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $locacao = Locacao::find($id);
        $equipamento = Equipamentos::find($locacao->equipamento_id);

        $locacao->delete();

        if ($equipamento) {
            $equipamento->update(['status' => 'disponivel']);
        }

        return redirect()->route('locacao.index')->with('success', 'Registro removido com sucesso!');
    }
}