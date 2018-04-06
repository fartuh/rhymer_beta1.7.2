<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rhyme extends Model
{
    protected $table = 'rhymes';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
