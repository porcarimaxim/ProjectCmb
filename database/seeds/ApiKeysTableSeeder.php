<?php

use App\Library\Models\ApiKey;
use App\Library\Models\Company;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ApiKeysTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();
		$companyIds = Company::lists('id')->all();
		ApiKey::create([
			'company_id' => $companyIds[0],
			'key' => 'cce12a070438ac8369624ab9981f182e'
		]);
		foreach (range(1, count($companyIds) - 1) as $index) {
			ApiKey::create([
				'company_id' => $companyIds[$index],
				'key' => $faker->md5()
			]);
		}
	}

}