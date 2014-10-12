<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entries', function(Blueprint $table) {
			$table->increments('id'); 
			$table->date('date'); 
			$table->time('start'); 
			$table->time('end'); 
			$table->string('hours', 50); 
			$table->string('moment', 200); 
			$table->text('work_description'); // JSON
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
		Schema::drop('entries'); 
	}

}
