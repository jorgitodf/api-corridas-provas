<?php

namespace App\Http\Controllers;

use App\Races;
use App\Runners;
use App\RunnersRaces;
use App\RunnersResult;
use App\Services\SortAge;

class RacesListingController extends Controller
{
    protected $runnersRaces;
    protected $runnersResult;
    protected $races;
    protected $runners;
    protected $idsRacer = [];

    /**
     * injeção de dependência dos objetos RunnersRaces, Races, Runners e RunnersResult
     *
     * @param RunnersRaces $runnersRaces
     * @param Races $races
     * @param Runners $runners
     * @param RunnersResult $runnersResult
     */
    public function __construct(
        RunnersRaces $runnersRaces,
        Races $races,
        Runners $runners,
        RunnersResult $runnersResult
    ) {
        $this->runnersRaces = $runnersRaces;
        $this->races = $races;
        $this->runners = $runners;
        $this->runnersResult = $runnersResult;
    }

    /**
     * Lista todos os resultados das provas para filtrar pela idade de cada corredor
     *
     * @return void
     */
    public function racesListingByAge()
    {
        $res = json_decode(json_encode($this->runnersResult->getResultsRunners()), true);
        $racesRes = json_decode(json_encode($this->races->getRaces()), true);

        /**
         * Armazena todos os ids das corridas em um array
         */
        foreach ($racesRes as $key => $value) {
            $this->idsRacer[] = $value['id'];
        }

        /**
         * Acrescenta no array de retorno dos dados das corridas com os corredores e o tempo de cada corrida
         * a idade calculada de cada corredor e o tempo da prova de cada corredor
         */
        foreach ($res as $key => $value) {
            $res[$key]['idade'] = idade($value['data_nascimento']);
            $res[$key]['tempo'] = tempo_prova($value['hora_inicio_prova'], $value['hora_final_prova']);
        }

        /**
         * Retorna os dados dos resultados das corridas para listagem por grupo de idade e classificação
         */
        return response()->json(SortAge::racesListingByAge($this->idsRacer, $res), 201);
    }

    /**
     * Lista todos os resultados das provas para filtrar de forma geral
     *
     * @return void
     */
    public function racesListingGeneral()
    {
        $res = json_decode(json_encode($this->runnersResult->getResultsRunners()), true);
        $racesRes = json_decode(json_encode($this->races->getRaces()), true);

        /**
         * Armazena todos os ids das corridas em um array
         */
        foreach ($racesRes as $key => $value) {
            $this->idsRacer[] = $value['id'];
        }

        /**
         * Acrescenta no array de retorno dos dados das corridas com os corredores e o tempo de cada corrida
         * a idade calculada de cada corredor e o tempo da prova de cada corredor
         */
        foreach ($res as $key => $value) {
            $res[$key]['idade'] = idade($value['data_nascimento']);
            $res[$key]['tempo'] = tempo_prova($value['hora_inicio_prova'], $value['hora_final_prova']);
        }

        /**
         * Retorna os dados dos resultados das corridas para listagem geral sepados por tipo de corrida e classificação
         */
        return response()->json(SortAge::racesListingGeneral($this->idsRacer, $res), 201);
    }
}
