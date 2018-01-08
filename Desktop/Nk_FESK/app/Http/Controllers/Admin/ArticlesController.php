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
		$articles = DB::table('clanak')->orderBy('id', 'desc')->get();
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

		$path = Storage::disk('uploads')->put("/clanci/slike/", $request->file('file'));
		if(isset($_FILES['attachment'])){
			$attachment = Storage::disk('uploads')->put("/clanci/prilozi/", $request->file('attachment'));
		}else{
			$attachment="NULL";
		}
		
		if(DB::table('clanak')->insert(['naziv'=> $request->get('name'), 'tekst' => $request->get('content'), 'slika' => "/uploads/".$path, 'dokument' => "/uploads/".$attachment])){			
			
			$message = "Članak je dodan.";
			if ($request->ajax()) {
				return response()->json([$message], 200);
			}
			session()->flash('success', $message);
			$articles = Articles::all();
			return view('admin.articles.index', ['articles' => $articles]);
			
		}else{
			
			$message = "Nije uspjelo spremanje članka.";
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
		$article = DB::table('clanak')->where('id', '=', $articleId)->first();
		DB::table('clanak')->where('id', '=', $articleId)->delete();
		
		//Deleting the picture
		$pictureName= $article->slika;
		$pictureName_array = explode('/', $pictureName);
		array_shift($pictureName_array);
		array_shift($pictureName_array);
		$pictureName=implode("/", $pictureName_array);
		Storage::disk('uploads')->delete('/'.$pictureName);
		
		//Deleting the attachment
		if(strlen($article->dokument)>0){
			$documentName= $article->dokument;
			$documentName_array = explode('/', $documentName);
			array_shift($documentName_array);
			array_shift($documentName_array);
			$documentName=implode("/", $documentName_array);
			Storage::disk('uploads')->delete('/'.$documentName);
		}

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
