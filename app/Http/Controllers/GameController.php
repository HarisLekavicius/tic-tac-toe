<?php

namespace App\Http\Controllers;

use App\Repositories\GameRepository;
use Illuminate\Http\Request;

class GameController extends Controller
{
    protected $request;
    protected $repo;

    public function __construct(Request $request, GameRepository $repo){
        $this->request = $request;
        $this->repo = $repo;
    }

    public function index(){
        return view('Welcome');
    } 
    
    public function store(){
        
        // declaring request variables
        $id = $this->request->get('id');
        $button = $this->request->get('btnTriggered');
        $gameLog = $this->request->get('gameLog');
        $markers = $this->request->get('markers');

        // call to repository class and return game logic data fron it
        return $this->repo->gameLogic($id, $button, $gameLog, $markers);
    }
}
