<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function(Blueprint $table) {
            $table->integer('id',true);
            $table->string('title', 45)->nullable();
            $table->string('description', 45)->nullable();
            $table->integer('database_limit')->nullable();
            $table->float('price', 10, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('offers');
    }
}
