<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForiegnKeys2ToResoursePermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('resourcepermissions', function(Blueprint $table)
		{
			$table->foreign('resource_id')->references('id')->on('resources');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('resourcepermissions', function(Blueprint $table)
		{
			//
		});
	}

}
