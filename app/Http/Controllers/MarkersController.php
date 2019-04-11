<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GamesLog;

class MarkersController extends Controller
{
    public function store(Request $request){

        // fill markers variable with database records (used to retrieve data on page refresh)
        $markers = $request->get('markers');
        $logs = GamesLog::get();
        foreach($logs as $log){
            $markers[$log->box_id] = $log->player;
        }
        return $markers;
   }
}
