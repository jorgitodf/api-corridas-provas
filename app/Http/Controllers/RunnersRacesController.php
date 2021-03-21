<?php

namespace App\Http\Controllers;

use App\Races;
use App\Runners;
use App\RunnersRaces;
use App\Validations\Validations;
use Illuminate\Http\Request;

class RunnersRacesController extends Controller
{
    protected $runnersRaces;
    protected $races;
    protected $runners;
    private $validations;

    /**
     * injeção de dependência dos objetos RunnersRaces, Races e Runners
     *
     * @param RunnersRaces $runnersRaces
     * @param Races $races
     * @param Runners $runners
     */
    public function __construct(RunnersRaces $runnersRaces, Races $races, Runners $runners)
    {
        $this->runnersRaces = $runnersRaces;
        $this->races = $races;
        $this->runners = $runners;
        $this->validations = new Validations();
    }

    /**
     * Armazena na base de dados a prova a ser realizada para cada corredor
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        $resRunner = $this->runners::find($dados['runner_id']);
        $resRacer = $this->races::find($dados['racer_id']);

        $resRunRac = $this->runnersRaces::query()->where('runner_id', '=', "{$resRunner['id']}")->get();
        $ids = [];
        foreach ($resRunRac as $key => $value) {
            array_push($ids, $value['racer_id']);
        }
        $resRacerData = $this->races::query()->whereIn('id', $ids)->get();

        /**
         * Realiza a validação dos dados vindos do formulário
         */
        $error = $this->validations->validateRunnersRaces($resRunner, $dados, $resRacer, $resRacerData);

        if (!$error) {
            try {
                $this->runnersRaces::create($dados);
                return response()->json(['success' => 'Inclusão de corredor em provas com Sucesso!'], 201);
            } catch (\Illuminate\Database\QueryException $ex) {
                $error['error_create'] = $ex->getMessage();
            }
        }

        return response()->json(['error' => $error], 403);
    }
}
