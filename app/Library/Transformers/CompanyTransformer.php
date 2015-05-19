<?php namespace App\Library\Transformers;

use App\Library\Models\Company;
use League\Fractal\TransformerAbstract;

class CompanyTransformer extends TransformerAbstract
{
	/**
	 * @param Company $company
	 * @return array
	 */
	public function transform(Company $company)
	{
		return [
			'id' => $company['id'],
			'name' => $company['name'],
			'email' => $company['email'],
			'updated_at' => $company['updated_at'],
			'created_at' => $company['created_at']
		];
	}
}