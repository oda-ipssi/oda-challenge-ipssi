<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('user_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->string('paymentMethod', 100);
            $table->float('amount');
            $table->float('cardNumber');
            $table->string('expirationDate', 5);
            $table->dateTime('created_at');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('payments');
    }
}
