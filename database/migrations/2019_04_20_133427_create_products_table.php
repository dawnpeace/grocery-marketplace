<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_produk',255);
            $table->boolean('tersedia')->default(1);
            $table->integer('jumlah_tersedia');
            $table->bigInteger('harga')->comment('harga satuan');
            $table->string('satuan_unit')->comment('satuan tersedia produk e.g Kg, Unit, Buah, Gr');
            $table->unsignedBigInteger('penjual_id');
            $table->foreign('penjual_id')->references('id')->on('tb_penjual');
            $table->text('deskripsi');
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
        Schema::dropIfExists('tb_produk');
    }
}
