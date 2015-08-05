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

		User::create([
			'company_id' => $companyIds[0],
			'first_name' => 'Porcari',
			'last_name' => 'Maxim',
			'email' => 'porcarimaxim@gmail.com',
			'password' => Hash::make('qwerty')
		]);

	    foreach(range(1, count($companyIds)-1) as $index)
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