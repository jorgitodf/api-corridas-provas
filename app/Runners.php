<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\RunnersRaces;

class Runners extends Model
{
    protected $fillable = ['nome', 'cpf', 'data_nascimento'];

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
     * Mutator para remover os espaços em braco da variável nome
     *
     * @param [type] $value
     * @return void
     */
    public function setCpfNome($value)
    {
        $this->attributes['nome'] = trim($value);
    }

    /**
     * Mutator para formatar o cpf, remove os . e o -
     *
     * @param [type] $value
     * @return void
     */
    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = preg_replace('/[^0-9]/', '', $value);
    }
}
