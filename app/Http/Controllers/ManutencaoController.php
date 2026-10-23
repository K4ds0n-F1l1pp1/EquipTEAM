<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manutencao;
use App\Models\Equipamentos;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Queue\RedisQueue;
use Throwable;

class ManutencaoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        if ($search) {
            $dados = Manutencao::where('descricao', 'like', '%' . $search . '%')
                ->orWhere('data_manutencao', 'like', '%' . $search . '%')
                ->orWhere('custo', 'like', '%' . $search . '%')
                ->get();
        } else {
            $dados = Manutencao::all();
        }

        return view('manutencao.list', compact('dados', 'search'));
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Manutencao::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Manutencao::All();
        }

        return view('manutencao.list', compact('dados'));
    }

    function create()
    {
        $equipamentos = Equipamentos::all();

        return view('manutencao.form', compact('equipamentos'));
    }

    function validateForm(Request $request)
    {
        $request->validate([
            'equipamento_id' => 'required',
            'descricao' => 'required',
            'data_manutencao' => 'required|date',
            'custo' => 'required|numeric',
        ],
        [
            'equipamento_id.required' => "Você precisa selecionar um :attribute!",
            'descricao.string' => "O :attribute deve ser caracter",
            'data_manutencao.date' => "A :attribute deve ser preenchida!",
            'custo.numeric' => "O :attribute deve ser númerico",
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);
        
        $dados = $request->all();

        if ($request->hasFile('foto')) {
            $dados['foto_manutencao'] = $request->file('foto')->store('manutencoes', 'public');
        }

        Manutencao::create($dados);

        return redirect()->route('manutencao.index')->with('success', 'Manutenção salva com sucesso!');
    }

    function edit($id)
    {
        $data = Manutencao::find($id);

        $equipamentos = Equipamentos::All();

        return view('manutencao.form')->with(compact('data', 'equipamentos'));
    }

    function update(Request $request, $id)
    {
        try {
            $this->validateForm($request);

            $item = Manutencao::find($id);
            $dados = $request->all();

            if ($request->hasFile('foto')) {
                $dados['foto_manutencao'] = $request->file('foto')->store('manutencoes', 'public');
            }

            $item->update($dados);

            return redirect()->route('manutencao.index')->with('success', 'Manutenção atualizada com sucesso!');
        } catch (Throwable $e)
        {
            echo "Não é possível editar. Erro: " . $e->getMessage() . "\n";
        };
    }

    function destroy($id)
    {
        try {
            $manutencao = Manutencao::findOrFail($id);

            Manutencao::destroy($id);
            return redirect()->route('manutencao.index')->with("success", 'Registro Removido com sucesso!');
        } catch (Throwable $e)
        {
            echo "Não é possível excluir. Erro: " . $e->getMessage() . "\n";
        };
    }

    public function report()
    {
        $manutencoes = Manutencao::with('equipamentos')->orderBy('id')->get();

        $data = [
            'titulo' => 'Relatório de Manutenções',
            'date' => date('m/d/Y'),
            'dados' => $manutencoes
        ];

        $pdf = Pdf::loadView('manutencao.report', $data);

        return $pdf->download('relatorio_manutencoes.pdf');
    }

}

