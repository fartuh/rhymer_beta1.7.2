<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rhymes(){
        return $this->hasMany('App\Rhyme', 'author_id', 'id');
    }

    public function authors()
    {
        return $this->belongsToMany('App\User', 'user_user', 'subscriber_id', 'author_id');
    }
    
    public function subscribers()
    {
        return $this->belongsToMany('App\User', 'user_user', 'author_id', 'subscriber_id');
    }
}
