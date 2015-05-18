<?php

use App\Library\Models\User;
use App\Library\Models\Company;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();
	    $companyIds = Company::lists('id');

	    foreach(range(0, count($companyIds)-1) as $index)
	    {
		    User::create([
			    'company_id' => $companyIds[$index],
			    'first_name' => $faker->firstName,
			    'last_name' => $faker->lastName,
			    'email' => $faker->email,
			    'password' => Hash::make('qwerty')
		    ]);
	    }
    }

}