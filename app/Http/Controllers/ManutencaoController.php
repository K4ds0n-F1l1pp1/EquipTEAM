<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manutencao;
use App\Models\Equipamentos;
use Exception;
use Illuminate\Queue\RedisQueue;
use Throwable;

class ManutencaoController extends Controller
{
    public function index(Request $request)
    {
        $dados = Manutencao::All();

        return view('manutencao.list', compact('dados', 'search'));
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
            'valor.numeric' => "O :attribute deve ser númerico",
        ]);
    }

    function store(Request $request)
    {
         try {
            $this->validateForm($request);

            $data = $request->All();

            Manutencao::create($data);

            return redirect('manutencao')->with("success", 'Registro Salvo com sucesso!');
        } catch (Throwable $e) // Permite pegar erros fatais de sintaxe ou memória.
        {
            echo "Não foi possível cadastrar. Erro:" . $e->getMessage() . "\n";
        };
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

            $data = $request->All();

            Manutencao::find($id)->update($data);
            return redirect('Manutencao')->with("success", 'Registro Atualizado com sucesso!');
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
            return redirect('Manutencao')->with("success", 'Registro Removido com sucesso!');
        } catch (Throwable $e)
        {
            echo "Não é possível excluir. Erro: " . $e->getMessage() . "\n";
        };
    }

}
