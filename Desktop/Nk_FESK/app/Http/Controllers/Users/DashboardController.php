<?php

namespace App\Http\Controllers\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Team;
use App\Articles;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Set middleware to quard controller.
     *
     * @return void
     */
      public function __construct()
      {
      }

      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {
		$teams = Team::all();
		$articles = DB::table('clanak')->orderBy('id', 'desc')->get();
		$articles = DB::table('clanak')->orderBy('id', 'desc')->limit(4)->get();
        return view('users.dashboard', ['articles' => $articles, 'teams' => $teams]);
      }
}
