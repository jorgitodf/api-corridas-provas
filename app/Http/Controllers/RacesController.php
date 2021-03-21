<?php

namespace App\Http\Controllers;

use App\Races;
use App\Validations\Validations;
use Illuminate\Http\Request;

class RacesController extends Controller
{
    protected $races;
    private $validations;

    /**
     * injeção de dependência dos objetos Races e Validations
     *
     * @param Races $races
     * @param Validations $validations
     */
    public function __construct(Races $races, Validations $validations)
    {
        $this->races = $races;
        $this->validations = $validations;
    }

    /**
     * Lista todas os tipos de provas cadastrados
     *
     * @return void
     */
    public function index()
    {
        return $this->races::all();
    }

    /**
     * Armazena na base de dados o tipo de prova ao ser cadastrada
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        /**
         * Realiza a validação dos dados vindos do formulário
         */
        $error = $this->validations->validateRaces($dados);

        if (!$error) {
            try {
                $this->races::create($dados);
                return response()->json(['success' => "{$dados['tipo_prova']} Cadastrada com Sucesso!"], 201);
            } catch (\Illuminate\Database\QueryException $ex) {
                $error['error_create'] = $ex->getMessage();
            }
        }

        return response()->json(['error' => $error], 403);
    }
}
