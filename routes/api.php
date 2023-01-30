<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrestadorController;
use App\Models\RedeBrasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/login', [AuthController::class, 'login']);

Route::get('/login', [AuthController::class, 'login']);

Route::post('/teste', [PrestadorController::class, 'teste']);

//Route::get('/teste', [PrestadorController::class, 'teste']);

Route::get('/teste', function (Request $request) {
    $query = RedeBrasil::query();
    // Filtro de estado
    if ($request->has('Estado')) {
        $query->where('Estado', 'LIKE', '%' . $request->Estado . '%');
        // Filtro de cidade
        if ($request->has('Cidade')) {
            $query->where('Cidade', 'LIKE', '%' . $request->Cidade . '%');
        } else {
            return 'Inclua a sigla de um cidade para busca com o parâmetro como o exemplo "&&Cidade=Alvorada"';
        }
        // Paginando as cidades
        $teste = $query->paginate();

        return $teste;
    } else {
        return 'Inclua a sigla de um estado para busca com o parâmetro como o exemplo "?Estado=RS"';
    }
    // Paginando os estados
    $teste = $query->paginate();

    return $teste;
});
    


/*
Route::middleware('auth:sanctum')->group(function () {
    Route::get('teste', function (Request $request) {
        //$con = new PDO(DBDRIVE . ': Server=' . DBHOST . '; Database=' . DBNAME, DBUSER, DBPASS, ['charset' => 'utf8']);


        // Selecionando prestadores;
        //$sql = "select CRO_UF_CRO, CPF_CNPJ, Nome, DDD + TELEFONE, DDD2 + Celular, Endereco, Bairro, CEP, Cidade, Estado, Emergência, 24_horas, Singular, Area_de_atuacao, Especialista from Rede_Brasil order by Nome asc";
        //$sql = $con->prepare($sql);
        //$sql->execute();

        $resultados = RedeBrasil::selectRaw('CRO_UF_CRO, cast(CPF_CNPJ as varchar(50)) as CPFCPNJ, Nome, concat(DDD , TELEFONE) as telefone, concat(DDD2 , Celular) as celular, Endereco, Bairro, CEP, Cidade, Estado, Emergência, 24_horas, Singular, Area_de_atuacao, Especialista')->get();


        //while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        // $resultados[] = $row;
        //}
        //$resultados = $this->utf8_converter($resultados);

        // Retorno quando não encontra prestadores
        if (!$resultados) {
            throw new Exception("Nenhum prestador encontrado!");
        }

        return $resultados;
    });
});
*/