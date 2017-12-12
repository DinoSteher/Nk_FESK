<?php

namespace App\Http\Controllers\Admin;

use Sentinel;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Documents;
use Storage;
use Illuminate\Support\Facades\DB;

class DocumentsController extends Controller
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
		$documents = Documents::all();
		return view('admin.documents.index', ['documents' => $documents]);
    }
	
	public function create(){
		return view('admin.documents.create');
	}
	
	public function store(Request $request)
    {
		$result = $this->validate($request, [
            'name' => 'required|max:255',
			'file' => 'required'
        ]);	
		$name = $request->get('name');
		$path = Storage::disk('uploads')->put("/dokumenti/", $request->file('file'));

		if(DB::table('dokument')->insert(['naziv'=> $name, 'putanja' => "/uploads/".$path])){			
			
			$message = "Dokument je dodan.";
			if ($request->ajax()) {
				return response()->json([$message], 200);
			}
			session()->flash('success', $message);
			$documents = Documents::all();
			return view('admin.documents.index', ['documents' => $documents]);
			
		}else{
			$message = "Nije uspjela izmjena momčadi.";
			if ($request->ajax()) {
                return response()->json($message, 422);
            }
            session()->flash('error', $message);
			$documents = Documents::all();
			return view('admin.documents.index', ['documents' => $documents]);
		}
	}
	
	public function destroy(Request $request, $documentId)
    {
        DB::table('dokument')->where('id', '=', $documentId)->delete();

        // All done
        $message = "Dokument je uklonjen.";
        if ($request->ajax()) {
            return response()->json([$message], 200);
        }

        session()->flash('success', $message);
		$documents = Documents::all();
		return view('admin.documents.index', ['documents' => $documents]);
    }
	
}
