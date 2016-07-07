<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('datas', function(Blueprint $table)
		{
			$table->integer('id',true);
			$table->boolean('is_public')->nullable();
			$table->integer('user_id',false,false);
			$table->string('path', 256);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('datas');
	}

}
