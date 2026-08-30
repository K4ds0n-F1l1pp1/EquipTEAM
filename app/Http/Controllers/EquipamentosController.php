<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamentos;

class EquipamentosController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        if($search) {
            $dados = Equipamentos::where('nome', 'like', '%' . $search . '%')->get();
        } else {
            $dados = Equipamentos::all();
        }

        return view('equipamento.list', compact('dados', 'search'));
    }

    public function create()
    {
        return view('equipamento.form');
    }

    public function validationForm(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'numero_serie' => 'required',
            'valor_diaria' => 'required|numeric',
        ], [
            'nome.required' => 'O :attribute é obrigatório!',
            'numero_serie.required' => 'O :attribute é obrigatório!',
            'valor_diaria.required' => 'O :attribute é obrigatório!',
            'valor_diaria.numeric' => 'O :attribute deve ser um número!',
        ]);
    }

    public function store(Request $request)
    {
        $this->validationForm($request);

        Equipamentos::create($request->all());

        return redirect()->route('equipamentos.index')->with('success', 'Registro salvo com sucesso!');
    }

    public function edit($id)
    {
        $data = Equipamentos::find($id);
        return view('equipamento.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validationForm($request);

        Equipamentos::find($id)->update($request->all());

        return redirect()->route('equipamentos.index')->with('success', 'Registro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Equipamentos::destroy($id);

        return redirect()->route('equipamentos.index')->with('success', 'Registro removido com sucesso!');
    }
}