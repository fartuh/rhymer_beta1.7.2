<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rhyme extends Model
{
    protected $table    = 'rhymes';

    protected $fillable = ['title', 'text', 'author_id'];

    public function author(){
        return $this->belongsTo('App\User');
    }
}
