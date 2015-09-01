<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    //

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Score');
    }
}
