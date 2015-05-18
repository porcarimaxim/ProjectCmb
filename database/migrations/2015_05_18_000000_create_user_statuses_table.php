<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatusesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_statuses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('company_id')->nullable()->unsigned()->index();
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
			$table->integer('user_id')->nullable()->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users');
			$table->boolean('is_available');
			$table->timestamps();
			$table->unique(['user_id', 'company_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_statuses');
	}

}
