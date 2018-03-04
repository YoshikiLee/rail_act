<?php

class Create_Downloads_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('downloads', function($table)
		{
			$table->create();
			$table->increments('id');
			$table->string('userid');
			$table->string('username');
			$table->string('filename');
			$table->string('fileextension');
			$table->boolean('isopen');
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('downloads');
	}

}
