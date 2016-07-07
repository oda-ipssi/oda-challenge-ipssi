<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id',true);
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstname', 45);
            $table->string('lastname', 45);
            $table->string('address', 45);
            $table->integer('zipcode');
            $table->string('city', 45);
            $table->string('phone', 45);
            $table->string('ip',15);
            $table->boolean('is_prospect');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
