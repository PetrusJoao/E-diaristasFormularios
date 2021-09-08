<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use App\Services\ViaCep;
use Illuminate\Http\Request;

class BuscaDiaristaCep extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ViaCep $viaCep)
    {
        $endereco = $viaCep->buscar($request->cep);

        if($endereco === false){
            return response()->json(['erro'=>'CEP inválido'], 400);
        }

        return [
            'diaristas' => Diarista::buscaPorCodigoIbge($endereco['ibge']),
            'quantidade_diaristas' => Diarista::quantidadePorCodigoIbge($endereco['ibge'])
        ];
        
    }
}
