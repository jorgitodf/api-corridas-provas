<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RunnersResult extends Model
{
    protected $fillable = ['runner_id', 'racer_id', 'hora_inicio_prova', 'hora_final_prova'];

    protected $table = 'runner_result';

    public $timestamps = false;

    /**
     * Seleciona os resultados das corridas com os corredores e o tempo de cada corrida
     *
     * @return array
     */
    public function getResultsRunners(): array
    {
        return DB::select('SELECT rac.id AS id_prova, rac.tipo_prova AS tipo_prova, run.id AS id_corredor,
            run.nome AS nome_corredor, run.data_nascimento AS data_nascimento,
            rs.hora_inicio_prova AS hora_inicio_prova, rs.hora_final_prova AS hora_final_prova
            FROM runner_result AS rs
            JOIN runners AS run ON (run.id = rs.runner_id)
            JOIN races AS rac ON (rac.id = rs.racer_id)
            ORDER BY TIMEDIFF(rs.hora_final_prova, rs.hora_inicio_prova) ASC');
    }
}
