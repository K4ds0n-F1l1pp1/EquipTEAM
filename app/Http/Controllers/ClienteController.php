<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dados = Cliente::All(); // Dá um SELECT ALL, literalmente.

        return view('cliente.list')->with(['dados' => $dados]); // Retorna a formação da View, onde é processado os dados
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cliente.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validationForm($request);

        Cliente::create($request->all());

        return redirect()->route('cliente.index')->with('success', 'Registro salvo com sucesso!');
    }

        public function validationForm(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf_cnpj' => 'required',
            'telefone' => 'required',
            'endereco' => 'required',
            'email' => 'required|email',
        ], [
            'nome.required' => 'O :attribute é obrigatório!',
            'cpf_cnpj.required' => 'O :attribute é obrigatório!',
            'telefone.required' => 'O :attribute é obrigatório!',
            'endereco.required' => 'O :attribute é obrigatório!',
            'email.required' => 'O :attribute é obrigatório!',
            'email.email' => 'O :attribute deve ser um email válido!',
            'valor_diaria.numeric' => 'O :attribute deve ser um número!',
        ]);
    }

    /**
     * Display the specified resource.
     */
        public function edit($id)
    {
        $data = Cliente::find($id);
        return view('cliente.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validationForm($request);

        Cliente::find($id)->update($request->all());

        return redirect()->route('cliente.index')->with('success', 'Registro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Cliente::destroy($id);

        return redirect()->route('cliente.index')->with('success', 'Registro removido com sucesso!');
    }
}
