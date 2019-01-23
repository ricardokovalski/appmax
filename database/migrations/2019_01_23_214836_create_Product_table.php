<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Product', function(Blueprint $table)
		{
			$table->increments('ProductID');
			$table->string('Name', 100);
			$table->text('Description', 65535);
			$table->integer('Amount');
			$table->decimal('Price', 10);
			$table->string('Sku', 8);
			$table->boolean('MethodInsert');
			$table->boolean('IsActive')->default(1);
			$table->dateTime('CreatedAt');
			$table->dateTime('UpdatedAt')->nullable();
			$table->dateTime('DeletedAt')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Product');
	}

}
