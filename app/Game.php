<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    protected $table = 'games';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'currentPlayer', 'winner',
    ];
}
