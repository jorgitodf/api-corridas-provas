<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RunnersRaces extends Model
{
    protected $fillable = ['runner_id', 'racer_id'];

    protected $table = 'runner_race';

    public $timestamps = false;
}
