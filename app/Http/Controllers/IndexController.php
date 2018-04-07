<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rhyme;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $rhymes = Rhyme::all();
        return view('index', ['rhymes' => $rhymes]);
    }
    
    public function account()
    {
        if(Auth::check()){
            $user = User::find(Auth::id());
            return view('account', ['user' => $user]);
        }
    }

    public function findaccount($id)
    {
        $user = User::find($id);
        return view('findaccount', ['user' => $user]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('index'));
    }        
    
    public function rhyme($id)
    {
        $rhyme = Rhyme::with('author')->get()->find($id);
        //dump($rhyme);
        return view('rhyme', ['rhyme' => $rhyme]);
    }

    public function rhymesme()
    {
        $rhymes = Rhyme::all()->where('author_id', Auth::id());
        return view('rhymesme', ['rhymes' => $rhymes]);
    }

    public function newRhyme()
    {
        return view('new');
    }

    public function newRhymePost(Request $r)
    {
        $data = $r->validate([
            'title' => 'required|min:8',
            'text'  => 'required|min:25'
        ]);
        if(empty($errors)){
            Rhyme::create([
                'title'     => $r['title'],
                'text'      => $r['text'],
                'author_id' => Auth::id()
            ]);
        }

        return view('new', ['data' => $data]);
    }
}
