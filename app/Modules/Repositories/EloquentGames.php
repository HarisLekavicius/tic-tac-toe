<?php

namespace App\Modules\Repositories;

use App\Repositories\GameRepository;

class Eloquent extends GameRepository implements GamesRepository
{
    protected $game;

    public function __construct(Game $game){
        $this->model = $game;
    }

    // declare eloquent querys here 
    public function resetPlayer(){
        $this->model->where('id', 1)->update('currentPlayer', 1);
    }

    public function resetWinner(){
        $this->model->where('id', 1)->update('winner', 0);
    }
}