<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_status_pengantaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('keranjang_id');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->boolean('telah_dijemput')->default(0);
            $table->boolean('telah_sampai')->default(0);
            $table->foreign('keranjang_id')->references('id')->on('tb_keranjang_belanja');
            $table->foreign('driver_id')->references('id')->on('tb_driver');
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
        Schema::dropIfExists('tb_status_pengantaran');
    }
}
