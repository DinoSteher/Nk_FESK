<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Centaur\AuthManager;
use App\Team;

class ContactController extends Controller
{
	
	public function __construct()
    {
    }
	
	public function index(Request $request)
    {
		$teams=Team::all();
		return view('users.contact', ['teams' => $teams]);
	}
}