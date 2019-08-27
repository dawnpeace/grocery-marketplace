<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentMethodToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_keranjang_belanja', function (Blueprint $table) {
            $table->string('nomor_identifikasi')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('metode_pengiriman')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_keranjang_belanja', function (Blueprint $table) {
            $table->dropColumn('nomor_identifikasi');
            $table->dropColumn('metode_pembayaran');
            $table->dropColumn('metode_pengiriman');
        });
    }
}
