<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //
  protected $table = 'scores';

  protected $fillable = ['score','user_id','map_id'];

  public function scopeHighestScore(){

  }

  public function user(){
    return $this->belongsTo('User');
  }
}
