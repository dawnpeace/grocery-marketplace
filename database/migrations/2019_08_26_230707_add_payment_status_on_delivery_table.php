<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentStatusOnDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_status_pengantaran',function(Blueprint $table){
            $table->boolean('telah_dibayarkan')->default(0);
            $table->boolean('sedang_diantarkan')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_status_pengantaran',function(Blueprint $table){
            $table->dropColumn('telah_dibayarkan');
            $table->dropColumn('sedang_diantarkan');
        });
    }
}
