<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;

class TicTacToeController extends Controller
{
    public function index(){
       $game = Game::all();

       return response()->json($game);
    }

    /*public function show($marker){
        $game = Game::find($marker);
    
        return response()->json($game);
    }*/
}

