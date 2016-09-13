<?php

use Illuminate\Database\Migrations\Migration;

class AddHashToPins extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pins', function($table)
		{
			$table->string('hash',5);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pins', function($table)
		{
    		$table->dropColumn('hash');
		});
	}

}

