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
        $user = Rhyme::find(Auth::user()->id);
        //dump($user);
        return view('account', ['user' => $user]);
    }

    public function findaccount($id)
    {
        return view('findaccount');
    }
}
