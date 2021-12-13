<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function review(){
        return $this->hasOne('App\Review');
    }
    public function user() {
        return $this-> belongsTo('App\User');
    }
}
