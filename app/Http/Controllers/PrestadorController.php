<?php

namespace App\Http\Controllers;

use App\Models\RedeBrasil;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PrestadorController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function teste()
    {
        $resultados = RedeBrasil::selectRaw('CRO_UF_CRO, cast(CPF_CNPJ as varchar(50)) as CPFCPNJ, Nome, concat(DDD , TELEFONE) as telefone, concat(DDD2 , Celular) as celular, Endereco, Bairro, CEP, Cidade, Estado, Emergência, 24_horas, Singular, Area_de_atuacao, Especialista')->get();

        if (!$resultados) {
            throw new Exception("Nenhum prestador encontrado!");
        }

        return $resultados;
    }
}
