<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('User', function(Blueprint $table)
		{
			$table->increments('UserID');
			$table->string('Name', 100);
			$table->string('Email');
			$table->string('Password');
			$table->string('RememberToken', 100)->nullable();
			$table->boolean('IsActive')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('User');
	}

}
