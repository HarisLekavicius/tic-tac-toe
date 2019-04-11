<?php

namespace App\Http\Controllers;

use App\GamesLog;


class GameLogsController extends Controller
{
    public function show(){
        
        // select both tables and declare an array which will be used to push logs
        $first_log = GamesLog::first();
        $logs = array();
        
        //while at least one log is active push the array a record from the database
        if(isset($first_log)){
            $select_logs = GamesLog::select('player', 'created_at')->orderBy('created_at', 'desc')->get();
            foreach($select_logs as $select_log){
                $log = 'Player ' . $select_log->player . ' placed a marker at ' . $select_log->created_at;
                array_push($logs, $log);
            }
            return $logs;
        }
    }
}
