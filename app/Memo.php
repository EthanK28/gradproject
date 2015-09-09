<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    //
    protected $fillable = ['me_send_mb_id', 'text', 'me_recv_mb_id', 'me_send_datetime', 'me_read_datetime'];

    public $timestamps = false;

    protected $dates = ['me_send_datetime', 'me_read_datetime'];

}
