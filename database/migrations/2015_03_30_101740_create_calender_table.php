<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalenderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calenders',function(Blueprint $table){
			$table->integer('nepali_year');
			$table->integer('month_code');
			$table->date('eng_start_date');
			$table->integer('no_days');
			$table->date('eng_end_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('calenders');
	}

}
