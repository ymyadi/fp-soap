<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsensLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen_log', function (Blueprint $table) {
            $table->increments('absen_log_id');
            $table->integer('mesin_id')->unsigned();
            $table->foreign('mesin_id')->references('mesin_id')->on('mesin')->onDelete('cascade');
            $table->integer('pin');
            $table->dateTime('date_time');
            $table->integer('ver');
            $table->integer('status_absen_id')->unsigned();
            $table->foreign('status_absen_id')->references('status_absen_id')->on('status_absen')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absen_log');
    }
}
