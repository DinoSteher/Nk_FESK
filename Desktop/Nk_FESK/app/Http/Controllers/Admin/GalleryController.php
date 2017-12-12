<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Centaur\AuthManager;
use App\Gallery;
use Storage;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{

	// @var Centaur\AuthManager 
    protected $authManager;
	
	public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }
	
	public function index()
    {
		$galleries = Gallery::all();
		return view('admin.gallery.index', ['galleries' => $galleries]);
	}
	
	public function create(){
		return view('admin.gallery.create');
	}
	
	public function store(Request $request){
		
	}
	
	public function edit(){
		
	}
	
	public function update(){
		
	}
}