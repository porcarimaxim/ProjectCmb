<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirebaseAccountsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('firebase_accounts', function (Blueprint $table) {
			$table->increments('id');
			$table->string('account')->nullable();
			$table->string('token')->nullable();
			$table->integer('company_id')->nullable()->unsigned()->index();
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
		Schema::drop('firebase_accounts');
	}
}
