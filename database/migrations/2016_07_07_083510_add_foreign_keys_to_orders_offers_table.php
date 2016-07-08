<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToOrdersOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_offers', function(Blueprint $table)
        {
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('offer_id')->references('id')->on('offers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_offers', function(Blueprint $table)
        {
            $table->dropForeign('order_id');
            $table->dropForeign('offer_id');
        });
    }
}
