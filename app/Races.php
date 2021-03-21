<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\RunnersRaces;
use Illuminate\Support\Facades\DB;

class Races extends Model
{
    protected $fillable = ['tipo_prova', 'data_prova'];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function runnersRaces()
    {
        return $this->belongsToMany(RunnersRaces::class, 'runner_race');
    }

    /**
     * Seleciona todos os Ids das provas
     *
     * @return array
     */
    public function getRaces(): array
    {
        return DB::select('SELECT id FROM races');
    }
}
