<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->increments('pegawai_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->integer('mesin_user_id')->unsigned();
            $table->foreign('mesin_user_id')->references('mesin_user_id')->on('mesin_users')->onDelete('cascade');
            $table->integer('jabatan_id')->unsigned();
            $table->foreign('jabatan_id')->references('jabatan_id')->on('jabatan')->onDelete('cascade');
            $table->string('nama');
            $table->string('email');
            $table->integer('jenis_kelamin_id')->unsigned();
            $table->foreign('jenis_kelamin_id')->references('jenis_kelamin_id')->on('jenis_kelamin')->onDelete('cascade');
            $table->string('no_ktp');
            $table->mediumText('alamat');
            $table->date('tgl_mulai_bekerja');
            $table->date('tgl_berhenti')->nullable();
            $table->integer('pegawai_status_id')->unsigned();
            $table->foreign('pegawai_status_id')->references('pegawai_status_id')->on('pegawai_status')->onDelete('cascade');
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
        Schema::dropIfExists('pegawai');
    }
}
