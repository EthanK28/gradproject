<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //
  protected $table = 'scores';

  protected $fillable = ['score'];

  public function scopeHighestScore(){

  }

  public function user(){
    return $this->belongsTo('User');
  }
}
