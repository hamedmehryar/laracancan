<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResoursepermissionRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resourcepermission_role', function(Blueprint $table)
		{
			$table->integer('resourcepermission_id')->unsigned()->nullable();
			$table->foreign('resourcepermission_id')->references('id')->on('resourcepermissions')
				->onDelete('cascade');

			$table->integer('role_id')->unsigned()->nullable();
			$table->foreign('role_id')->references('id')->on('roles');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resourcepermission_role');
	}

}
