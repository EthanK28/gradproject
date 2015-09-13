<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    //
    protected $table = 'words';

    protected $fillable = ['name','type', 'definition'];

    public function scopeRecent($query)
    {
        // 최근 열개 목록 보여주기
    }



}
