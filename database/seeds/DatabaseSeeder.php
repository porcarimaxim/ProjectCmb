<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('CompaniesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('CallsTableSeeder');
		$this->call('ApiKeysTableSeeder');
		$this->call('FirebaseAccountsTableSeeder');
	}

	private function cleanDatabase()
	{
		DB::statement('TRUNCATE TABLE companies CASCADE;');
		DB::statement('TRUNCATE TABLE users CASCADE;');
		DB::statement('TRUNCATE TABLE calls CASCADE;');
		DB::statement('TRUNCATE TABLE api_keys CASCADE;');
		DB::statement('TRUNCATE TABLE firebase_accounts CASCADE;');
	}

}
