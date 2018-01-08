<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Centaur\AuthManager;
use App\Team;
use App\Player;
use Storage;
use Illuminate\Support\Facades\DB;

class PlayersController extends Controller
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
	
	public function index()
    {
		$teams = Team::all();
		$players = Player::all();
		return view('admin.players.index', ['teams' => $teams, 'players' => $players]);
	}
	
	public function create()
    {
		$teams = Team::all();
		return view('admin.players.create', ['teams' => $teams]);
	}
	
	public function store(Request $request)
    {
		$result = $this->validate($request, [
            'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'teamId' => 'required',
			'position' => 'required',
			'date' => 'required',
			'file' => 'required'
        ]);	
		$name = $request->get('first_name');	
		$surname = $request->get('last_name');
		$teamId = $request->get('teamId');
		$position = $request->get('position');
		$date = $request->get('date');
		$path = Storage::disk('uploads')->put("/igraci/".$teamId, $request->file('file'));
		$targetPath = $path;
		if(DB::table('igrac')->insert(['id_ekipa' => $teamId, 'datum_rodenja'=> $date, 'ime'=> $name, 'pozicija' => $position, 'prezime' => $surname, 'slika' => "/uploads/".$targetPath])){			
			$message = "Igrač je dodan.";
			if ($request->ajax()) {
				return response()->json([$message], 200);
			}
			session()->flash('success', $message);
			$teams = Team::all();
			$players = Player::all();
			return view('admin.players.index', ['teams' => $teams, 'players' => $players]);
		}else{
			$teams = Team::all();
			$players = Player::all();
			return view('admin.players.index', ['teams' => $teams, 'players' => $players]);
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

        $playerId = $id;
		$teamName = $request->get('naziv');
		$igrac = DB::table('igrac')->where('id', '=', $playerId)->first();
		$filename= $igrac->slika;
		$filename_array = explode('/', $filename);
		array_shift($filename_array);
		array_shift($filename_array);
		$filename=implode("/", $filename_array);
		Storage::disk('uploads')->delete('/'.$filename);
        DB::table('igrac')->where('id', '=', $playerId)->delete();
		
        // All done
        $message = "Igrač je uklonjen.";
		if ($request->ajax()) {
            return response()->json([$message], 200);
        }

        session()->flash('success', $message);
        $teams = Team::all();
		$players = Player::all();
		return view('admin.players.index', ['teams' => $teams, 'players' => $players]);
    }
	
	public function edit($playerId){
		$player = DB::table('igrac')->where('id', '=', $playerId)->first();
		$teams = Team::all();
		return view('admin.players.edit', ['player' => $player, 'teams' => $teams]);
	}
	
	public function update(Request $request, $id){
		$result = $this->validate($request, [
            'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
        ]);

		if($_FILES['file']['size'] > 0){
			$oldPath =DB::table('igrac')->select('slika')->where('id','=', $id)->first();
			$path = Storage::disk('uploads')->put("/igraci/".$request->get('teamId'), $request->file('file'));
			
			//Deleting the old photo
			$igrac = DB::table('igrac')->where('id', '=', $id)->first();
			$filename= $igrac->slika;
			$filename_array = explode('/', $filename);
			array_shift($filename_array);
			array_shift($filename_array);
			$filename=implode("/", $filename_array);
			Storage::disk('uploads')->delete('/'.$filename);
			
			DB::table('igrac')
            ->where('id','=', $id)
            ->update(['ime' => $request->get('first_name'),'datum_rodenja' => $request->get('date'), 'prezime' => $request->get('last_name'),
						'id_ekipa' => $request->get('teamId'), 'pozicija' => $request->get('position'),
						'slika' => "/uploads/".$path]);
			$message = "Igrač je izmjenjen.";
			if ($request->ajax()) {
				return response()->json([$message], 200);
			}
			session()->flash('success', $message);
		}elseif($_FILES['file']['size'] == 0){
			DB::table('igrac')
            ->where('id','=', $id)
            ->update(['ime' => $request->get('first_name'),'datum_rodenja' => $request->get('date'), 'prezime' => $request->get('last_name'),
						'id_ekipa' => $request->get('teamId'), 'pozicija' => $request->get('position')]);
			$message = "Igrač je izmjenjen.";
			if ($request->ajax()) {
				return response()->json([$message], 200);
			}
			session()->flash('success', $message);
		}

		$teams = Team::all();
		$players = Player::all();
		return view('admin.players.index', ['teams' => $teams, 'players' => $players]);
	}
	
	
}
