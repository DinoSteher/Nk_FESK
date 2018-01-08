<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Articles;
use App\Team;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
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
        $articles = DB::table('clanak')->orderBy('id', 'desc')->get();
		$teams=Team::all();
		return view('users.articles', ['teams' => $teams, 'articles' => $articles]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $article = Articles::where('id','=', $id)->first();
		$teams=Team::all();
		return view('users.article', ['teams' => $teams, 'article' => $article]);
    }

}
