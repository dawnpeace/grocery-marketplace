<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penjual', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references('id')->on("users");
            $table->string("kota");
            $table->string('nama_toko');
            $table->string("no_telp");
            $table->unsignedBigInteger('pasar_id');
            $table->foreign('pasar_id')->references('id')->on('tb_pasar');
            $table->boolean("telah_diverifikasi")->default(0);
            $table->string("alamat",255);
            $table->string("deskripsi")->nullable();
            $table->string("foto_profil")->nullable();
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
        Schema::dropIfExists('tb_penjual');
    }
}
