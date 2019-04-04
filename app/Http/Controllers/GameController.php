<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Game;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class GameController extends Controller
{
    public function index(){
        return view('Welcome');
    } 
    
    public function store(Request $request){

        // declaring request variables
        $id = $request->get('id');
        $button = $request->get('btnTriggered');
        $gameLog = $request->get('gameLog');
        $markers = $request->get('markers');
        
        // reset database tables if button was clicked
        if(isset($button)){
            $resetPlayer = DB::table('games')->where('id', 1)->update(['currentPlayer' => 1]);
            $resetWinner = DB::table('games')->where('id', 1)->update(['winner' => 0]);
            $resetLogs = DB::table('games_log')->delete();
            return $markers;
        }
       
        // game cycle
        $game = DB::table('games')->first();
        while($game->winner == 0 && empty($markers[$id])){
            
            // board filling, log filling and player changing
            if($game->currentPlayer == 1){
                $markers[$id] = 'X';
                DB::table('games')->where('id', 1)->update(['currentPlayer' => 2]);
                DB::table('games_log')->insert(
                    ['box_id' => $id, 'player' => 'X', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
                );
            }
            else if($game->currentPlayer == 2){
                $markers[$id] = 'O';
                DB::table('games')->where('id', 1)->update(['currentPlayer' => 1]);
                DB::table('games_log')->insert(
                    ['box_id' => $id, 'player' => 'O', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
                );
            }

             // ---game logic---

            // if board was filled with no winner, return a Draw
            if(count(array_filter($markers)) == 9 && $game->winner == 0){
                DB::table('games')->where('id', 1)->update(['winner' => 3]);
            }
            
            // columns
            for($i=1; $i<8; $i += 3){
                if($markers[$i] == 'X' && $markers[$i+1] == 'X' && $markers[$i+2] == 'X'){
                    DB::table('games')->where('id', 1)->update(['winner' => 1]);
                }
                if($markers[$i] == 'O' && $markers[$i+1] == 'O' && $markers[$i+2] == 'O'){
                    DB::table('games')->where('id', 1)->update(['winner' => 2]);
                }
            }
            
            // rows
            for($i=1; $i<4; $i++){
                if($markers[$i] == 'X' && $markers[$i+3] == 'X' && $markers[$i+6] == 'X'){
                    DB::table('games')->where('id', 1)->update(['winner' => 1]);
                }
                if($markers[$i] == 'O' && $markers[$i+3] == 'O' && $markers[$i+6] == 'O'){
                    DB::table('games')->where('id', 1)->update(['winner' => 2]);
                }
            }

            // crosswise
            if($markers[1] == 'X' && $markers[5] == 'X' && $markers[9] == 'X'){
                DB::table('games')->where('id', 1)->update(['winner' => 1]);
            }
            if($markers[1] == 'O' && $markers[5] == 'O' && $markers[9] == 'O'){
                DB::table('games')->where('id', 1)->update(['winner' => 2]);
            }
            if($markers[3] == 'X' && $markers[5] == 'X' && $markers[7] == 'X'){
                DB::table('games')->where('id', 1)->update(['winner' => 1]);
            }
            if($markers[3] == 'O' && $markers[5] == 'O' && $markers[7] == 'O'){
                DB::table('games')->where('id', 1)->update(['winner' => 2]);
            }
            return $markers;
        }       

        // return already placed markers if nothing happened or a winner was announced
        return $markers;
    }

    public function logs(Request $request){
        
        // select both tables and declare an array which will be used to push logs
        $game =  DB::table('games')->first();
        $first_log = DB::table('games_log')->first();
        $logs = array();
        
        //while at least one log is active push the array a record from the database
        while(isset($first_log)){
            $select_logs = DB::table('games_log')->select('player', 'created_at')->orderBy('created_at', 'desc')->get();
            foreach($select_logs as $select_log){
                $log = 'Player ' . $select_log->player . ' placed a marker at ' . $select_log->created_at;
                array_push($logs, $log);
            }
            return $logs;
        }
    }

    public function currentPlayer(Request $request){
        $game = DB::table('games')->first();

        // while there is no winner show the current player
        while($game->winner == 0){
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

    public function markers(Request $request){

         // fill markers variable with database records (used to retrieve data on page refresh)
         $markers = $request->get('markers');
         $logs = DB::table('games_log')->get();
         foreach($logs as $log){
             $markers[$log->box_id] = $log->player;
         }
         return $markers;
    }
}
