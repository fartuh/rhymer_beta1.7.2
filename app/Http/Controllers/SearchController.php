<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rhyme;

class SearchController extends Controller
{
    
    protected $tag = "";

    public function tag($tag)
    {   

        $this->tag = $tag;
        $check  = true;

        $rhymes = Rhyme::whereHas('categories', function ($query) {
            $query->where('name', 'like', trim($this->tag));
        })->get();

        foreach($rhymes as $r){
            $check = false;
        }

        return view('index', ['rhymes' => $rhymes->reverse(), 'check' => $check]);
    }
}
