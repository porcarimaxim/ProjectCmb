<?php

use App\Library\Models\Company;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompaniesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

	    foreach(range(0, 3) as $index)
	    {
	        Company::create([
		        'name' => $faker->company,
		        'email' => $faker->companyEmail,
		        'firebase_key' => $faker->md5()
	        ]);
        }
    }

}