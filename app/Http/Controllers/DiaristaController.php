<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use Illuminate\Http\Request;

class DiaristaController extends Controller
{
    /**
     * Lista as diaristas
     *
     * @return void
     */
    public function index()
    {        
        $diaristas = Diarista::get();
        
        return view('index', [
            'diaristas' => $diaristas
        ]);
    }

    public function create()
    {
        /**
         * Mostra o formulário de criação
         */
        return view('create');
    }

    public function store(Request $request)
    {
        /**
         * Cria uma diarista no banco de dados
         */
        $dados = $request->except('_token');
        $dados['foto_usuario'] = $request->foto_usuario->store('public');

        $dados['cpf'] = str_replace(['.', '-'], '', $dados['cpf']);
        $dados['cep'] = str_replace('-', '', $dados['cep']);
        $dados['telefone'] = str_replace(['(', ')', ' ', '-'], '', $dados['telefone']);

        Diarista::create($dados);

        return redirect()->route('diaristas.index');
    }

    public function edit(int $id)
    {
        /**
         * Mostra o fomulario de edição populado
         */
        $diarista = Diarista::findOrfail($id);

        return view('edit', [
            'diarista' => $diarista
        ]);
    }

    public function update(int $id, Request $request)
    {
        /**
         * Atualiza uma diarista no banco de dados
         */
        $diarista = Diarista::findOrfail($id);

        $dados = $request->except('_token', '_method');

        $dados['cpf'] = str_replace(['.', '-'], '', $dados['cpf']);
        $dados['cep'] = str_replace('-', '', $dados['cep']);
        $dados['telefone'] = str_replace(['(', ')', ' ', '-'], '', $dados['telefone']);

        if($request->hasFile('foto_usuario')){
            $dados['foto_usuario'] = $request->foto_usuario->store('public');
        }

        $diarista->update($dados);

        return redirect()->route('diaristas.index');
    }

    public function destroy(int $id)
    {
        /**
         * Apaga uma diarista no banco de dados
         */
        $diarista = Diarista::findOrfail($id);

        $diarista->delete();

        return redirect()->route('diaristas.index');
    }
}
