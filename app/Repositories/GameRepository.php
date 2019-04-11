<?php

namespace App\Repositories;

use App\Game;
use App\GamesLog;
use Carbon\Carbon;

Class GameRepository
{   
    public function gameLogic($id, $button, $gameLog, $markers){
        
        // 2 main variables for eloquent queries
        $game = Game::first();
        $gameLog = new GamesLog;
        
        // reset database tables if button was clicked
        if(isset($button)){
            $game->update(['currentPlayer' => 1, 'winner' => 0]);
            $gameLog->truncate();
            return $markers;
        }

        // ---game logic---
        if($game->winner == 0 && empty($markers[$id])){
            
            // board filling, log filling and player changing
            
            if($game->currentPlayer == 1){
                $markers[$id] = 'X';
                $game->update(['currentPlayer' => 2]);
                $gameLog->insert(['box_id' => $id, 'player' => 'X', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
            else{
                $markers[$id] = 'O';
                $game->update(['currentPlayer' => 1]);
                $gameLog->insert(['box_id' => $id, 'player' => 'O', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
        }

        // anti cheat
        
        // prevent adding or removing markers
        $box_id = $gameLog->select('box_id')->get();
        if(count(array_filter($markers)) > count($box_id) || count(array_filter($markers)) < count($box_id)){
            $game->update(['winner' => 4]);
            return $markers;
        }

        // prevent changing a marker but it's not finished

        // $validate = $gameLog->get();
        // $markers_filtered = array_filter($markers);
        // $markers_sorted = array();
        // foreach($markers_filtered as $filtered){

        // }
        
        // $k = 0;
        // foreach($validate as $val){
        //     if( $val->player != $markers_sorted[$k] ){
        //         return var_dump($markers_sorted);
        //         $game->update(['winner' => 4]);
        //         return $markers;
        //     }
        //     $k++;
        // }

        // if board was filled with no winner, return a Draw
        if(count(array_filter($markers)) == 9 && $game->winner == 0){
           $game->update(['winner' => 3]);
            return $markers;
        }
        
        // columns
        for($i=1; $i<8; $i += 3){
            if($markers[$i] == 'X' && $markers[$i+1] == 'X' && $markers[$i+2] == 'X'){
                $game->update(['winner' => 1]);
                return $markers;
            }
            if($markers[$i] == 'O' && $markers[$i+1] == 'O' && $markers[$i+2] == 'O'){
                $game->update(['winner' => 2]);
                return $markers;
            }
        }
        
        // rows
        for($i=1; $i<4; $i++){
            if($markers[$i] == 'X' && $markers[$i+3] == 'X' && $markers[$i+6] == 'X'){
                $game->update(['winner' => 1]);
                return $markers;
            }
            if($markers[$i] == 'O' && $markers[$i+3] == 'O' && $markers[$i+6] == 'O'){
                $game->update(['winner' => 2]);
                return $markers;
            }
        }

        // crosswise
        if($markers[1] == 'X' && $markers[5] == 'X' && $markers[9] == 'X'){
            $game->update(['winner' => 1]);
            return $markers;
        }
        if($markers[1] == 'O' && $markers[5] == 'O' && $markers[9] == 'O'){
            $game->update(['winner' => 2]);
            return $markers;
        }
        if($markers[3] == 'X' && $markers[5] == 'X' && $markers[7] == 'X'){
            $game->update(['winner' => 1]);
            return $markers;
        }
        if($markers[3] == 'O' && $markers[5] == 'O' && $markers[7] == 'O'){
            $game->update(['winner' => 2]);
            return $markers;
        }
        return $markers;
    }
}
