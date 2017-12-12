<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Centaur\AuthManager;
use App\Team;
use App\Player;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('sentinel.auth');
        $this->middleware('sentinel.role:subscriber');
    }
	
	public function index(Request $request, $id)
    {
		$teams=Team::all();
		$team = Team::where('id', '=', $id)->first();
		$players = Player::where('id_ekipa', '=', $id)->get();
		return view('users.teams', ['teams' => $teams, 'team' => $team, 'players'=> $players ]);
	}
}