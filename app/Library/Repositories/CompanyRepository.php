<?php namespace App\Library\Repositories;

use App\Library\Models\Company;
use App\Library\RepositoriesInterface\CompanyInterface;

class CompanyRepository extends Repository implements CompanyInterface
{
	public function getModel()
	{
		return new Company;
	}

	/**
	 * @param $apiKey
	 */

	public function getByApiKey($apiKey)
	{
		$company = $this->getModel()->join('api_keys',
			function( $join ) use ( &$apiKey ) {
				$join   ->on('companies.id', '=', 'api_keys.company_id')
						->where('api_keys.key', '=', $apiKey);
			}
		)->first();

		return $company;
		// TODO: Implement getByApiKey() method.
	}
}