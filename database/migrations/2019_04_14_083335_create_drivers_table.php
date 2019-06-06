<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_driver', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references('id')->on("users");
            $table->string("plat_nomor_kendaraan");
            $table->string("no_telp");
            $table->string("kota");
            $table->string("alamat",255);
            $table->boolean("telah_diverifikasi")->default(0);
            $table->string('foto_profil')->nullable();
            $table->string('nomor_sim');
            $table->string('foto_sim')->nullable();
            $table->boolean('sedang_bekerja')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_driver');
    }
}
