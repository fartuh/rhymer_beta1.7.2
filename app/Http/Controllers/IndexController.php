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
        return view('index', ['rhymes' => $rhymes->reverse()]);
    }
    
    public function profile()
    {
        if(Auth::check()){
            $rhymes = Rhyme::all()->where('author_id', Auth::id());
            $user = User::find(Auth::id());
            return view('profile', ['user' => $user, 'rhymes' => $rhymes->reverse()]);
        }
    }

    public function findprofile($id)
    {
        $rhymes = Rhyme::all()->where('author_id', Auth::id());
        $user = User::find($id);
        return view('findprofile', ['user' => $user, 'rhymes' => $rhymes->reverse]);
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

    public function delete($id)
    {
        if(Auth::check())
        {
            if(Rhyme::find($id)->author->id == Auth::id()){
                Rhyme::destroy([$id]);
                return redirect(route('profile'));
            } 
            else {
                return view('errors.try');
            }   
        }
    }
}
