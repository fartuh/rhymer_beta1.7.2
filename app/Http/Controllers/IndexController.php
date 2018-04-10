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
        $check  = true;

        foreach($rhymes as $r){
            if(isset($r->id)) $check = false;
        }

        return view('index', ['rhymes' => $rhymes->reverse(), 'check' => $check]);
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
                if($c == "" || $c == " ") continue;
                $check = Category::where('name', $c)->get();
                foreach($check as $ch){
                    if($ch->name != $c){
                        $check_bool = false;
                    }
                    else {
                        $check_bool = true;
                        $category_id = (int)$ch->id;
                    }
                }
                if(!isset($check_bool)) $check_bool = false;
                if($check_bool)
                {
                    echo $category_id;
                    unset($chek_bool);
                }
                else{

                    $category_created = Category::create([
                        'name' => $c
                    ]);
                    $category_id = $category_created->id;
                }

                DB::table('category_rhyme')->insert([
                        'rhyme_id'    => $id->id,
                        'category_id' => $category_id
                    ]);
                unset($check_bool);
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
        if(Rhyme::find($id)->author->id == Auth::id()){
            $rhyme = Rhyme::find($id);
            $tags  = ""; 

            foreach($rhyme->categories as $c){
                $tags .= $c->name . ", ";
            }

            return view('editRhyme', ['rhyme' => $rhyme, 'id' => $id, 'tags' => $tags]);
        }
        else{
            return view('errors.try');
        }
    }

    public function editRhymePost(Request $r)
    {
        
        $data = $r->validate([
            'id'         => 'required',
            'title'      => 'required|min:8',
            'text'       => 'required|min:20',
            'categories' => 'min:2'
        ]);

        if(Rhyme::find($data['id'])->author->id != Auth::id())
            return view('errors.try');

        $categories     = explode(',', trim($data['categories']));  
        if(empty($errors))
        {
            $rhyme = Rhyme::find($data['id']);
            $rhyme->title = $data['title'];
            $rhyme->text = $data['text'];
            $rhyme->save();
            
            DB::table('category_rhyme')->where('rhyme_id', $rhyme->id)->delete();

            foreach($categories as $c){
                $c = trim($c);
                if($c == "" || $c == " ") continue;
                $check = Category::where('name', $c)->get();
                foreach($check as $ch){
                    if($ch->name != $c){
                        $check_bool = false;
                    }
                    else {
                        $check_bool = true;
                        $category_id = (int)$ch->id;
                    }
                }
                if(!isset($check_bool)) $check_bool = false;
                if($check_bool)
                {
                    echo $category_id;
                    unset($chek_bool);
                }
                else{

                    $category_created = Category::create([
                        'name' => $c
                    ]);
                    $category_id = $category_created->id;
                }

                DB::table('category_rhyme')->insert([
                        'rhyme_id'    => $rhyme->id,
                        'category_id' => $category_id
                    ]);
                unset($check_bool);
            }
            
            return redirect(route('rhyme', ['id' => $data['id']]));
        }
        else {
            return redirect(route('index'));
        }

    } 
}
