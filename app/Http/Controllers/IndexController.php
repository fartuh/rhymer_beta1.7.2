<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Rhyme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    protected $id = 1;

    public function index()
    {
        $rhymes = Rhyme::all();
        $check  = true;

        foreach($rhymes as $r){
            if(isset($r->id)) $check = false;
        }

        return view('index', ['rhymes' => $rhymes->reverse(), 'check' => $check]);
    }
    
    public function rhyme($id)
    {
        $rhyme = Rhyme::with('author')->get()->find($id);
        //dump($rhyme);
        return view('rhyme', ['rhyme' => $rhyme]);
    }
}
