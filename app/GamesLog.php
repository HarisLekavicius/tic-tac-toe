<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamesLog extends Model
{
    protected $table = 'games_log';
    public $primaryKey = 'id';
    public $timestamps = true;
}
