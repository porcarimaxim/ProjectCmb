<?php

use App\Library\Models\Company;
use App\Library\Models\FirebaseAccount;
use Illuminate\Database\Seeder;

class FirebaseAccountsTableSeeder extends Seeder
{

	public function run()
	{
		$companyIds = Company::lists('id')->all();

		foreach (range(0, count($companyIds) - 1 ) as $index) {
			FirebaseAccount::create([
				'company_id' => $companyIds[$index],
				'account' => 'project-cmb',
				'token' => 'XFAnHqy24K1KeW0QUuI60Wm1d2T38tZGjCP31omb'
			]);
		}
	}

}