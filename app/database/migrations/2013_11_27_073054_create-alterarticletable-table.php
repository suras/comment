<?php

use Illuminate\Database\Migrations\Migration;

class CreateAlterarticletableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::table('articles', function($table) {
			
			$table->integer('user_id');
			$table->integer('number_of_endorsements')->default(0);
			$table->integer('image_id');
			$table->boolean('active')->default(1);
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}