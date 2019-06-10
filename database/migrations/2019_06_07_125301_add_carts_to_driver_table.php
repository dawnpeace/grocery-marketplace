<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCartsToDriverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_driver', function (Blueprint $table) {
            $table->unsignedBigInteger('keranjang_id')->nullable();
            $table->foreign('keranjang_id')->references('id')->on('tb_keranjang_belanja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_driver', function (Blueprint $table) {
            $table->dropForeign(['keranjang_id']);
            $table->dropColumn('keranjang_id');
        });
    }
}
