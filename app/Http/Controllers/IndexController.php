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
    public function index()
    {
        $rhymes = Rhyme::all();
        return view('index', ['rhymes' => $rhymes->reverse()]);
    }
    
    /*public function profile()
    {
        if(Auth::check()){
            $rhymes = Rhyme::all()->where('author_id', Auth::id());
            $user = User::find(Auth::id());
            return view('profile', ['user' => $user, 'rhymes' => $rhymes->reverse()]);
        }
    }*/

    public function profile($id)
    {
        $rhymes = Rhyme::all()->where('author_id', $id);
        $user = User::find($id);
        return view('profile', ['user' => $user, 'rhymes' => $rhymes->reverse()]);
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
            'title'         => 'required|min:8',
            'text'          => 'required|min:20',
            'categories'    => 'min:2'
        ]);
        if(empty($errors)){
            $categories     = explode(',', trim($data['categories']));  
            $id = Rhyme::create([
                'title'     => $data['title'],
                'text'      => $data['text'],
                'author_id' => Auth::id()
            ]);
            foreach($categories as $c){
                $c = trim($c);
                $check = DB::table('categories')->select('name')->where('name', $c)->get();
                foreach($check as $ch){
                    if($ch === "") $check_bool = true;
                }
                if(!isset($check_bool)) $check_bool = false;
                if($check_bool)
                {
                    unset($chek_bool);
                }
                else{

                    Category::create([
                        'name' => $c
                    ]);
                }

                $category = DB::table('categories')->select('id')->where('name', $c)->get();

                foreach($category as $categ){
                    $category_id = (int)$categ->id;
                }
                DB::table('category_rhyme')->insert([
                        'rhyme_id'    => $id->id,
                        'category_id' => $category_id
                    ]);
            }
            

            return redirect(route('rhyme', ['id' => $id]));
        }

        return view('new', ['data' => $data]);
    }

    public function delete($id)
    {
        if(Auth::check())
        {
            if(Rhyme::find($id)->author->id == Auth::id()){
                DB::table('category_rhyme')->where('rhyme_id', $id)->delete();
                Rhyme::destroy([$id]);
                return redirect(route('profile', ['id' => Auth::id()]));
            } 
            else {
                return view('errors.try');
            }   
        }
    }

    public function editRhyme($id)
    {
        $rhyme = Rhyme::find($id);
        return view('editRhyme', ['rhyme' => $rhyme, 'id' => $id]);
    }

    public function editRhymePost(Request $r)
    {
        $data = $r->validate([
            'id'    => 'required',
            'title' => 'required|min:8',
            'text'  => 'required|min:20'
        ]);
        if(empty($errors))
        {
            $rhyme = Rhyme::find($data['id']);
            $rhyme->title = $data['title'];
            $rhyme->text = $data['text'];
            $rhyme->save();
            return redirect(route('rhyme', ['id' => $data['id']]));
        }
        else {
            return redirect(route('index'));
        }

    } 
}
