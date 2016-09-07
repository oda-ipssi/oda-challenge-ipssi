<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->integer('id',true);
			$table->integer('vat')->nullable();
			$table->integer('status');
			$table->integer('user_id',false,false);
			$table->integer('offer_id');
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->float('price');

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
