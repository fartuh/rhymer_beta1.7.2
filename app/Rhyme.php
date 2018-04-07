<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rhyme extends Model
{
    protected $table = 'rhymes';

    public function author(){
        return $this->belongsTo('App\User');
    }
}
