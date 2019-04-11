<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class CurrentPlayerController extends Controller
{
    public function store(Request $request){
        $game = Game::first();

        // while there is no winner show the current player
        if($game->winner == 0){
            if($game->currentPlayer == 1){
                $currentPlayer = 'X';
            }
            if($game->currentPlayer == 2){
                $currentPlayer = 'O';
            }
            return 'Current player is: ' . $currentPlayer;
        }

        // if someone won the game or it was a draw return the needed string accordingly
        if($game->winner == 1){
            return 'Winner is: X';
        }
        if($game->winner == 2){
            return 'Winner is O';
        }
        if($game->winner == 3){
            return "It's a Draw";
        }
    }
}
