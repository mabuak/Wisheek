<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.	
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username',32)->unique();
			$table->string('email',64)->unique();
			$table->string('password');
			$table->string('first_name',32);
			$table->string('last_name',32);
			$table->string('avatar')->default('img/default_avatar.png');
			$table->boolean('welcome')->default(1);
			$table->boolean('admin')->default(0);
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
			$table->rememberToken();
			$table->datetime('last_login')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::drop('users');
	}

}