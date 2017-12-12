<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Centaur\AuthManager;
use App\Team;
use Illuminate\Support\Facades\DB;

class TeamsController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('sentinel.auth');
        $this->middleware('sentinel.role:administrator');
    }
	
	public function index()
    {
		$teams = Team::all();
		return view('admin.teams.index', ['teams' => $teams]);
	}
	
	public function create()
    {
		return view('admin.teams.create');
	}
	
	public function store(Request $request)
    {
		$result = $this->validate($request, [
            'naziv' => 'required|max:255|unique:ekipa',
        ]);	
		$name = $request->get('naziv');		
		if(DB::table('ekipa')->insert([['naziv' => $name]])){
			$message = "Momčad je izmijenjena.";
			if ($request->ajax()) {
				return response()->json([$message], 200);
			}
			session()->flash('success', $message);
			$teams = Team::all();
			return view('admin.teams.index', ['teams' => $teams]);
		}
	}
	
	 /**
     * Remove the specified team from storage.
     *
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Fetch the user object
        //$id = $this->decode($hash);
        $teamId = $id;
		$teamName = $request->get('naziv');

        // Check to be sure user cannot delete himself
        /*if (Sentinel::getUser()->id == $user->id) {
            $message = "You cannot remove yourself!";

            if ($request->ajax()) {
                return response()->json($message, 422);
            }
            session()->flash('error', $message);
            return redirect()->route('users.index');
        }*/


        // Remove the user
        DB::table('ekipa')->where('id', '=', $teamId)->delete();

        // All done
        $message = "Momčad je uklonjena.";
        if ($request->ajax()) {
            return response()->json([$message], 200);
        }

        session()->flash('success', $message);
        $teams = Team::all();
		return view('admin.teams.index', ['teams' => $teams]);
    }
	
	public function edit($teamId){
		$team = DB::table('ekipa')->where('id', '=', $teamId)->first();
		return view('admin.teams.edit', ['team' => $team]);
	}
	
	public function update(Request $request, $id){
		$result = $this->validate($request, [
            'naziv' => 'required|max:255',
        ]);			
		
		if(DB::table('ekipa')->where('id','=', $id)->update(['naziv' => $request->get('naziv')])){
			
			$message = "Momčad je izmijenjena.";
			if ($request->ajax()) {
				return response()->json([$message], 200);
			}
			session()->flash('success', $message);
			
		}else{
			
			$message = "Nije uspjela izmjena momčadi.";
			if ($request->ajax()) {
                return response()->json($message, 422);
            }
            session()->flash('error', $message);
            return redirect()->back()->withInput();
			
		}
		
		$teams = Team::all();
		return view('admin.teams.index', ['teams' => $teams]);
	}
	
	
}
