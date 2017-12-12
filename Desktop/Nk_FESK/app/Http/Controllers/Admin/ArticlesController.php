<?php

namespace App\Http\Controllers\Admin;

use Sentinel;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Articles;
use Storage;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
  /**
   * Set middleware to quard controller.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('sentinel.auth');
        $this->middleware('sentinel.role:administrator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$articles = Articles::all();
		return view('admin.articles.index', ['articles' => $articles]);
    }
	
	public function create()
	{
		return view('admin.articles.create');
	}
	
	public function store(Request $request)
	{
		$result = $this->validate($request, [
            'name' => 'required',
			'content' => 'required',
			'file' => 'required'
        ]);	

		$path = Storage::disk('uploads')->put("/clanci/", $request->file('file'));
		
		if(DB::table('clanak')->insert(['naziv'=> $request->get('name'), 'tekst' => $request->get('content'), 'slika' => "/uploads/".$path])){			
			
			$message = "Članak je dodan.";
			if ($request->ajax()) {
				return response()->json([$message], 200);
			}
			session()->flash('success', $message);
			$articles = Articles::all();
			return view('admin.articles.index', ['articles' => $articles]);
			
		}else{
			
			$message = "Nije uspjela izmjena momčadi.";
			if ($request->ajax()) {
                return response()->json($message, 422);
            }
            session()->flash('error', $message);
            return redirect()->back()->withInput();
			$articles = Articles::all();
			return view('admin.articles.index', ['articles' => $articles]);
			
		}
	}
	
	public function destroy(Request $request, $articleId)
	{
		DB::table('clanak')->where('id', '=', $articleId)->delete();

        // All done
        $message = "Članak je uklonjen.";
        if ($request->ajax()) {
            return response()->json([$message], 200);
        }

        session()->flash('success', $message);
		$articles = Articles::all();
		return view('admin.articles.index', ['articles' => $articles]);
		
	}
	
	public function edit(Request $request, $articleId)
	{
		$article = DB::table('clanak')->where('id', '=', $articleId)->first();
		return view('admin.articles.edit', ['article' => $article]);
	}
	
	public function update(Request $request, $articleId)
	{
		$result = $this->validate($request, [
            'name' => 'required',
			'content' => 'required',
        ]);
		if($_FILES['file']['size']>0){
			$oldPath =DB::table('clanak')->select('slika')->where('id','=', $articleId)->first();
			//Storage::disk('uploads')->delete($oldPath);
			$path = Storage::disk('uploads')->put("/clanci/", $request->file('file'));
			$message = "Članak je izmijenjen.";
			if ($request->ajax()) {
				return response()->json([$message], 200);
			}
			session()->flash('success', $message);
		}elseif($_FILES['file']['size']==0){
			$path = DB::table('clanak')->select('slika')->where('id','=', $articleId)->first();
			DB::table('clanak')
            ->where('id','=', $articleId)
            ->update(['naziv' => $request->get('name'), 'tekst' => $request->get('content')]);
			$message = "Članak je izmijenjen.";
			if ($request->ajax()) {
				return response()->json([$message], 200);
			}
			session()->flash('success', $message);
		}else{
			$message = "Nije uspjela izmjena članka.";
			if ($request->ajax()) {
                return response()->json($message, 422);
            }
            session()->flash('error', $message);
            return redirect()->back()->withInput();
		}
		
		
		$articles= Articles::all();
		return view('admin.articles.index', ['articles' => $articles]);
		
	}
}
