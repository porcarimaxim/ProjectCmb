<?php namespace Library\Repositories;

use App\Library\Models\Company;

class CompanyRepository extends Repository implements CompanyRepositoryInterface
{
	public function __construct()
	{
		$this->model = new Company;
	}
}