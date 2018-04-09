<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table    = 'categories';

    protected $fillable = ['name'];

    public function rhymes(){
        return $this->belongsToMany('App\Rhyme');
    }   
}
