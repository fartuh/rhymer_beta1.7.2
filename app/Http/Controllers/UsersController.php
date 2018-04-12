<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Rhyme;
use App\User;

class UsersController extends Controller
{
    protected $id = 1;

    public function profile($id)
    {
        $this->id  = $id;
        $subscribe = false;

        $check_r = DB::table('user_user')->select('id')->where([
            'subscriber_id' => Auth::id(),
            'author_id'     => $this->id
        ])->get();
        
        foreach($check_r as $c){
            if(isset($c->id)) $subscribe = true;
        }

        $user   = User::with('rhymes')->find($id);
        $rhymes = $user->rhymes;
        return view('profile', ['user' => $user, 'rhymes' => $rhymes->reverse(), 'subscribe' => $subscribe]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('index'));
    }

    public function feed()
    {
        $users = User::find(Auth::id())->authors;
        foreach($users as $user){
            $rhymes[] = $user->rhymes;
        }

        $check = true;

        if(!isset($rhymes)) $rhymes = [];

        foreach($rhymes as $rhyme){
            foreach($rhyme as $r){
                if(isset($r->id)) $check = false;
            }
        }
        // $rhymes = Rhyme::ss
        return view('feed', ['rhymes' => $rhymes, 'check' => $check]);
    }

    public function subscribe($id)
    {   
            $this->id = $id;
            $check    = true; 

            $check_r = DB::table('user_user')->select('id')->where([
                'subscriber_id' => Auth::id(),
                'author_id'     => $this->id
            ])->get();

            foreach($check_r as $c){
                if(isset($c->id)) $check = false;
            }

            if($check){
                DB::table('user_user')->insert([
                    'subscriber_id' => Auth::id(),
                    'author_id'     => $id
                ]);
            
            }

            return redirect(route('profile', ['id' => $id]));
    
    }

    public function unsubscribe($id)
    {
            $this->id = $id;
            $check    = false; 

            $check_r = DB::table('user_user')->select('id')->where([
                'subscriber_id' => Auth::id(),
                'author_id'     => $this->id
            ]);

            foreach($check_r->get() as $c){
                if(isset($c->id)) $check = true;
            }

            if($check){
                $check_r->delete();
            }

            return redirect(route('profile', ['id' => $id]));

    }

    public function subscribeOn()
    {
        $check = true;

        //$users = DB::table('user_user')->select('name')->where('subscriber_id', Auth::id());
        
        $users = User::whereHas('subscribers', function ($query) {
            $query->where('subscriber_id', Auth::id());
        })->get();
        
        foreach($users as $u){
            if(isset($u->name)) $check = false;
        }
        return view('info', ['users' => $users, 'check' => $check]);
    }
    
    public function subscribers()
    {
        $check = true;

        //$users = DB::table('user_user')->select('name')->where('subscriber_id', Auth::id());
        
        $users = User::whereHas('authors', function ($query) {
            $query->where('author_id', 'like', Auth::id());
        })->get();
        
        foreach($users as $u){
            if(isset($u->name)) $check = false;
        }
        return view('info', ['users' => $users, 'check' => $check]);
    }
}
