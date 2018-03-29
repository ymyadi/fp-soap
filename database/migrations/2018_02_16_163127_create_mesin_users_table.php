<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesinUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesin_users', function (Blueprint $table) {
            $table->increments('mesin_user_id');
            $table->integer('mesin_id')->unsigned();
            $table->foreign('mesin_id')->references('mesin_id')->on('mesin')->onDelete('cascade');
            $table->string('nama');
            $table->integer('user_id');
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
        Schema::dropIfExists('mesin_users');
    }
}
