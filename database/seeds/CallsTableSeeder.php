<?php

use App\Library\Models\User;
use App\Library\Models\Company;
use App\Library\Models\Call;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CallsTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();
	    $companyIds = Company::lists('id');
	    $userIds = User::lists('id');

	    foreach(range(0, 100) as $index)
	    {
		    Call::create([
			    'company_id' => $faker->randomElement($companyIds),
			    'user_id' => $faker->randomElement($userIds),
			    'number' => $faker->phoneNumber
		    ]);
	    }
    }

}