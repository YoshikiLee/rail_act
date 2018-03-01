<?php

class Create_Contents_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contents', function($table)
		{
			$table->create();
			$table->increments('id');
			$table->string('name')->unique();
			$table->integer('order')->unique();
			$table->string('extension');
			$table->string('description');
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
		Schema::drop('files');
	}

}
