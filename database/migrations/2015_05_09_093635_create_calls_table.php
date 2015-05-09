<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calls', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('company_id')->nullable()->unsigned()->index();
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
			$table->integer('user_id')->nullable()->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->string('number')->nullable();
			$table->integer('timer')->nullable();
			$table->string('description')->nullable();
			$table->enum('status', ['active', 'done'])->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('calls');
	}

}
