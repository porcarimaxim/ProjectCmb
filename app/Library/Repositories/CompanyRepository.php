<?php namespace App\Library\Repositories;

use App\Library\Models\Company;
use App\Library\RepositoriesInterface\CompanyInterface;

class CompanyRepository extends Repository implements CompanyInterface
{
	public function getModel()
	{
		return new Company;
	}
}