<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    //

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Score');
    }

    public function scores()
    {
        return $this->hasMany('App\Score');
    }
}
