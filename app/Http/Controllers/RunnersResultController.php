<?php

namespace App\Http\Controllers;

use App\Races;
use App\Runners;
use App\RunnersRaces;
use App\RunnersResult;
use App\Validations\Validations;
use Illuminate\Http\Request;

class RunnersResultController extends Controller
{
    protected $runnersResult;
    protected $runnersRaces;
    protected $runners;
    protected $races;
    protected $validations;

    /**
     * injeção de dependência dos objetos RunnersResult, RunnersRaces, Runners e Races
     *
     * @param RunnersResult $runnersResult
     * @param RunnersRaces $runnersRaces
     * @param Runners $runners
     * @param Races $races
     */
    public function __construct(
        RunnersResult $runnersResult,
        RunnersRaces $runnersRaces,
        Runners $runners,
        Races $races
    ) {
        $this->runnersResult = $runnersResult;
        $this->runnersRaces = $runnersRaces;
        $this->runners = $runners;
        $this->races = $races;
        $this->validations = new Validations();
    }

    public function index()
    {
        return $this->runnersResult::all();
    }

    /**
     * Armazena na base de dados os dados do resultado da prova corredor ao ser cadastrada
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        $resRunner = $this->runners::find($dados['runner_id']);
        $resRacer = $this->races::find($dados['racer_id']);

        /**
         * Verifica se já foi cadastrado o resultado da corrida do corredor para evitar a duplicidade
         */
        if (
            count($this->runnersResult::query()->where([['racer_id', '=', "{$dados['racer_id']}"],
            ['runner_id', '=', "{$dados['runner_id']}"]])->get()) > 0
        ) {
            return response()->json(['error' => "O resultado da prova para este corredor já fo cadastrado!"], 403);
        }

        /**
         * Verifica se a prova existe cadastrada para o corredor para impedir o registro
         * de um resultado sem prova cadastrada
         */
        if (empty($this->runnersRaces::query()->where('racer_id', '=', "{$dados['racer_id']}")->get())) {
            return response()->json(['error' => "Esta prova não está cadastrada para este corredor!"], 403);
        }

        /**
         * Realiza a validação dos dados vindos do formulário
         */
        $error = $this->validations->validateRunnersResult($dados, $resRunner, $resRacer);

        if (!$error) {
            try {
                $this->runnersResult::create($dados);
                return response()->json(['success' => "Inclusão dos resultados do corredor
                 {$resRunner[0]['nome']} com Sucesso!"], 201);
            } catch (\Illuminate\Database\QueryException $ex) {
                $error['error_create'] = $ex->getMessage();
            }
        }

        return response()->json(['error' => $error], 403);
    }
}
