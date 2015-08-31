<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('me_recv_mb_id')->unsigned();
            $table->foreign('me_recv_mb_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('me_send_mb_id')->unsigned();
            $table->foreign('me_send_mb_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('me_send_datetime');
            $table->timestamp('me_read_datetime');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('memos');
    }
}
