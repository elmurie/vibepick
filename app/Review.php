<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    public function vote(){
        return $this->belongsTo('App\Vote');
    }
}
