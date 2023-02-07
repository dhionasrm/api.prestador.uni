<?php

namespace App\Http\Controllers;

use App\Models\RedeBrasil;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PrestadorController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ListaPrestador(Request $request)
    {
        $query = RedeBrasil::query();
        // Filtro de estado
        if ($request->has('Estado')) {
            $query->where('Estado', 'LIKE', '%' . $request->Estado . '%');
            // Filtro de cidade
            if ($request->has('Cidade')) {
                $query->where('Cidade', 'LIKE', '%' . $request->Cidade . '%');
            }
            // Paginando as cidades
            $teste = $query->paginate();

            return $teste;
        }
        // Paginando os estados
        $teste = $query->paginate();

        return $teste;
    }
}