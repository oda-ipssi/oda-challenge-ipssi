<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_offers', function(Blueprint $table)
        {
            $table->integer('order_id');
            $table->integer('offer_id');
            $table->primary(['order_id','offer_id']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders_offers');
    }
}
